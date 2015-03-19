<?php namespace MightyCode\Autoscout24Adapter\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use MightyCode\Autoscout24Adapter\Models\CarInfo;
use MightyCode\Autoscout24Adapter\Models\Settings;
use October\Rain\Exception\ApplicationException;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Sunra\PhpSimple\HtmlDomParser;

class ImportInfoCommand extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'autoscout:importads';

    /**
     * @var string The console command description.
     */
    protected $description = 'Import ads from given URL';

    protected $baseUrl = "http://www.autoscout24.ch";
    //protected $adUrl = "/HCI/CustomList.aspx?cuid=%s&member=%s&view=extended";
    protected $adUrl = '/de/hci/list?design=177&filter=174';

    protected $url;

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        $this->url = $this->getUrl();
        parent::__construct();
    }

    protected function getUrl()
    {
        $clientID = Settings::instance()->client_id;

        if (empty($clientID)) {
            throw new ApplicationException("Client ID not set in settings!");
        }

        return $this->baseUrl . $this->adUrl; //sprintf($this->adUrl,$clientID,$clientID);
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $this->output->writeln('Starting Import!');

        DB::beginTransaction();

        try {

            $newCars = array();

            $this->output->writeln('fetch and prepare data for import');

            $dom = HtmlDomParser::file_get_html($this->url);

            $lis = $dom->find('.object-list-item');

            $this->output->writeln("found " . count($lis) . " items");

            foreach ($lis as $li) {
                $carInfo = new CarInfo();

                $carImgUrl = $li->find('a.object-thumb img', 0)->attr["src"];

                //fix image size
                $carImgUrl = str_replace("90x68/0", "640x2048/3", $carImgUrl);

                $carInfo->imageUrl = $carImgUrl;

                $titleAnchor = $li->find('h2.title-secondary a', 0);
                $carInfo->title = $titleAnchor->plaintext;

                $detailUrl = $titleAnchor->attr["href"];
                $carInfo->detailUrl = $this->baseUrl . html_entity_decode($detailUrl);

                $descDiv = $li->find('.container-right p.description', 0);
                $carInfo->description = html_entity_decode($descDiv->plaintext);

                $yearDiv = $li->find('li.date span.text', 0);
                $carInfo->age_group = $yearDiv->plaintext;

                $mileageDiv = $li->find('li.mileage span.text', 0);
                $carInfo->mileage = $mileageDiv->plaintext;

                $priceDiv = $li->find('li.price strong', 0);
                $carInfo->price = $priceDiv->plaintext;

                $newCars[] = $carInfo;

                $this->output->writeln($carInfo->title . ' added to importlist...');
            }

            if (count($newCars) > 0) {

                $this->output->writeln(sprintf('clear and import %s new ads', count($newCars)));

                //can't use truncate here cause its DDL and not DML like Delete. That means it will cause a implicit commit!
                //http://stackoverflow.com/a/5972738
                //CarInfo::truncate();

                //have to use DELETE from {tableName}
                $carTableName = with(new CarInfo())->getTable();
                DB::statement('DELETE FROM ' . $carTableName);

                foreach ($newCars as $car) {
                    $car->save();
                }

                DB::commit();
            } else {
                $this->output->writeln('nothing to import found!');
            }
        } catch (\Exception $ex) {
            $this->output->writeln('error occured and changes has been rollbacked! Message: ' . $ex->getMessage());
            DB::rollback();
        }
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

}
<?php namespace MightyCode\Autoscout24Adapter\Console;

use Illuminate\Console\Command;
use MightyCode\Autoscout24Adapter\Models\CarInfo;
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
    protected $adUrl = "/HCI/CustomList.aspx?cuid=%s&member=%s&view=extended";

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
        //TODO Read client ID from settings
        //test value: 61647
        return $this->baseUrl . sprintf($this->adUrl,61647,61647);
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $this->output->writeln('Starting Import!');

        $this->output->writeln('Clear Table!');

        CarInfo::truncate();

        $dom = HtmlDomParser::file_get_html($this->url);

        $divs = $dom->find('.list [class*=row]');

        //echo count($divs);
        foreach ($divs as $div) {
            $carInfo = new CarInfo();

            $imageDiv = $div->find('.imgCol', 0);
            $carImgUrl = $imageDiv->find('.galExtImg', 0)->attr["src"];

            //fix image size
            $carImgUrl = str_replace("95x71/0", "300x2048/3", $carImgUrl);

            $carInfo->imageUrl = $carImgUrl;

            $titleDiv = $div->find('.custListExtMakeModel', 0);
            $carInfo->title = $titleDiv->find('a', 0)->plaintext;

            $detailUrl = $titleDiv->find('a', 0)->attr["href"];
            $carInfo->detailUrl = $this->baseUrl . $detailUrl;

            $descDiv = $div->find('.custListExtDescr', 0);
            $carInfo->description = $descDiv->plaintext;

            $colorDiv = $div->find('.custListExtBodyType', 0);
            $carInfo->color = html_entity_decode($colorDiv->plaintext);

            $yearDiv = $div->find('.custListExtYearCol', 0);
            $carInfo->age_group = $yearDiv->plaintext;

            $mileageDiv = $div->find('.custListExtMileageCol', 0);
            $carInfo->mileage = $mileageDiv->plaintext;

            $priceDiv = $div->find('.custListExtPriceCol', 0);
            $carInfo->price = $priceDiv->plaintext;

            $carInfo->save();

            $this->output->writeln($carInfo->title . ' imported...');
        }
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [
            //['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [
            //['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

}
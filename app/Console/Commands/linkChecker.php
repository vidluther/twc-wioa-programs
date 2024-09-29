<?php

namespace App\Console\Commands;

use App\Models\Program;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Exception\MalformedUriException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class linkChecker extends Command
{
    private ?array $badUrls;

    private ?array $goodUrls;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check provider and campus urls for errors.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->goodUrls = [];
        $this->badUrls = [];

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $programs = Program::all(); //->take(100);
        $counter = 1;

        // $url = "https://www.goapprenticeship.com";

        foreach ($programs as $program) {
            $this->info($counter.': Checking Links for '.$program->program_url);

            $this->checkUrls($program->program_url, $counter);
            //$this->checkUrls($program->provider_url);
            $counter++;
        }

        return 0;
    }

    private function checkUrls($url, $counter)
    {
        //$url = "https://https:www.angelo.edudeptnursingprograms.php";
        //$url = 'https://www.wetraincdldrivers.com';
        // If the url is not in the goodUrl or badUrl array, check it.
        if (! in_array($url, $this->goodUrls) && (! in_array($url, $this->badUrls))) {

            $client = new \GuzzleHttp\Client;

            try {
                $response = $client->request('GET', $url,
                    [
                        'allow_redirects' => true,
                        'User-Agent' => 'Mozilla/5.0 (Windows NT x.y; rv:10.0) Gecko/20100101 Firefox/10.0',
                        'verify' => false,
                    ]);
            } catch (ClientException $ce) {
                $this->error("$url  is returning ".$ce->getResponse()->getStatusCode());
                $this->logBrokenLink($url);

            } catch (ServerException $s) {
                $this->badUrls[] = $url;
                echo $this->error("$url is returning ".$s->getMessage());
                $this->logBrokenLink($url);
            } catch (RequestException $re) {
                $this->badUrls[] = $url;
                echo $this->error("Could not talk to $url because..of a Request Exception");
                $this->logBrokenLink($url);
            } catch (MalformedUriException $mu) {
                $this->badUrls[] = $url;
                echo $this->error("Could not talk to $url because..".$mu->getMessage());
                $this->logBrokenLink($url);
            } catch (ConnectException $coe) {
                $this->badUrls[] = $url;
                echo $this->error("Could not talk to $url because..".$coe->getMessage());
                $this->logBrokenLink($url);
            }

            $this->goodUrls[] = $url;

        } else {
            //$this->info("Skipped $url because it was already checked. ($counter)");
        }
    }

    private function logBrokenLink($url)
    {
        Storage::append('linkchecker.log', "$url");
    }
}

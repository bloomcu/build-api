<?php

namespace DDD\Domain\Pages\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Bus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

// Models
use DDD\Domain\Sites\Site;
use DDD\Domain\Pages\Page;

// Facades
use Illuminate\Support\Facades\Http;

// Services
use DDD\App\Services\UrlService;

class CrawlPageJob implements ShouldQueue
{
    use Batchable,
        Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public $timeout = 10;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * Public variables.
     */
    public $site;
    public $page;

    /**
     * Contructor
     *
     * @return void
     */
    public function __construct(Site $site, Page $page)
    {
        $this->site = $site;
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // if ($this->batch()->cancelled()) {
        //     return;
        // }

        // Get page
        // $response = Http::get('http://localhost:5001/bloomcu-scraping-functions/us-central1/cheerio/page', [
        $response = Http::get('https://us-central1-bloomcu-scraping-functions.cloudfunctions.net/cheerio/page', [
            'url' => $this->page->url,
        ])->json();

        // Fail job
        if ($response['status'] !== 200) {
            $this->page->update([
                'is_crawled' => 1,
                'status'     => $response['status'],
            ]);

            return true;
        }

        // Update page
        $this->page->update([
            'is_crawled' => 1,
            'status'     => $response['status'],
            'title'      => $response['title'],
            'wordcount'  => $response['wordcount'],
            // 'body'       => $response['body']
        ]);

        // Empty array for next set of jobs
        // $jobs = [];

        // Iterate over each link
        // TODO: Update "links" in response to "urls"
        foreach ($response['links'] as $url) {
            // TODO: Right an action that processes the page via a pipeline?
            if (
                // TODO: Get the host and sheme in the crawler function
                UrlService::getHost($url['url']) === $this->site->host // Host matches site
                && UrlService::getScheme($url['url']) === $this->site->scheme // Scheme matches site
                // && !Page::where('url', $url['url'])->exists() // Doesn't already exist
            ) {

                $page = $this->site->pages()->firstOrCreate(
                    ['url' => $url['url']],
                    [
                        'type'       => $url['type'],
                        'url'        => $url['url'],
                        'is_crawled' => false,
                    ]
                );

                // Crawl it
                if ($url['type'] === 'link') {
                    // $jobs[] = new CrawlPageJob($this->site, $page);
                    // dispatch(new self($this->site, $page));
                    CrawlPageJob::dispatch($this->site, $page);
                }
            }
        }

        // Bus::batch($jobs)->dispatch();
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        // Use https://www.larabug.com/ here
    }
}

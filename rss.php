<?php


class rss
{
    public $rssLinks;
    public $rssContent;

    const CACHE_FILE = '/rss-cache.json';
    const CONFIG_FILE = '/config.json';

    /**
     * rss constructor.
     * @param $rssLinks
     */
    public function __construct(array $rssLinks)
    {
        $this->rssLinks = $rssLinks;
        $this->rssContent = [];
    }

    public function isCacheExpired()
    {
        if (!file_exists(__DIR__ .self::CACHE_FILE) || (time() - filemtime(__DIR__ .self::CACHE_FILE) > 900 )) {
            return true;
        }
        return false;
    }

    public function getXml()
    {
        foreach ($this->rssLinks as $link) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            try {
                $result = curl_exec($ch);
                $content = json_decode(json_encode(simplexml_load_string($result)), true);
                foreach ($content['channel']['item'] as $item) {
                    $this->rssContent[] = ["title" => $item['title'], "link" => $item['link'], "pubdate" => $item['pubDate'], "source" => $link];
                }
            } catch (Exception $exception) {
                //
            }
            curl_close($ch);
        }
        uasort($this->rssContent, function ($a, $b) {
            return new DateTime($b['pubdate']) <=> new DateTime($a['pubdate']);
        });
        $this->writeCache();
    }

    public function writeCache()
    {
        file_put_contents(__DIR__ .self::CACHE_FILE, json_encode($this->rssContent));
    }
}
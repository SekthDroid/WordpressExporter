<?php

/**
 *  Read the config file
 */
function loadConfig()
{
    return json_decode(file_get_contents("config.json"));
}

/**
 *
 * @param type $page
 * @return \PostResponse
 */
function fetch($url, $page)
{
    $url  = $url . "?json=get_posts&page=" . $page;
    $data = file_get_contents($url);
    if ($data) {
        return new PostResponse($data);
    }

    return PostResponse::EMPTY_RESPONSE();
}

function getPosts($url)
{
    $page         = 1;
    $posts        = array();
    $postResponse = fetch($url, $page);
    while (!$postResponse->hasErrors() && !$postResponse->isFinalPage()) {
        $posts        = array_merge($posts, $postResponse->posts());
        $postResponse = fetch($url, $postResponse->page() + 1);
    }
    return $posts;
}

function generateName($id, $slug)
{
    return "$id--$slug.html";
}

function serializePostCollection($directory, $posts = array())
{
    array_walk($posts, function ($post) use ($directory) {
        serializePost($directory, $post);
    });
}

function serializePost($directory, $post)
{
    $name = generateName($post->id, $post->slug);
    file_put_contents($directory . "/" . $name, $post->content);
}

function verifyOutputFolder()
{
    if (!file_exists("posts")) {
        mkdir("posts");
    }
}

/**
 *
 */
class PostResponse
{

    private $rawData;

    public function __construct($data)
    {
        $this->rawData = json_decode($data);
    }

    /**
     *
     * @return integer
     */
    public function page()
    {
        return (int) $this->rawData->query->page;
    }

    /**
     *
     * @return bool
     */
    public function hasErrors()
    {
        return $this->rawData === false;
    }

    /**
     *
     * @return array
     */
    public function posts()
    {
        return $this->rawData->posts;
    }

    /**
     *
     * @return bool
     */
    public function isFinalPage()
    {
        return $this->totalPages() === $this->page();
    }

    /**
     *
     * @return integer
     */
    public function totalPages()
    {
        return $this->rawData->pages;
    }

    /**
     *
     * @return \PostResponse
     */
    public static function EMPTY_RESPONSE()
    {
        return new PostResponse(false);
    }

}

<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Video is a video content
 */
class Video extends Publishing
{

    protected $embedUrl;

    public function getUrl()
    {
        return $this->embedUrl;
    }

    public function setUrl($url)
    {
        $this->embedUrl = $url;
    }

    /**
     * Gets the template name for embedding the video
     *
     * Note: not really a break of SRP since in theory the template name
     * could be infered with the video url.
     *
     * @return string
     */
    public function getTemplateName()
    {
        // for now, only youtube video
        return 'youtube';
    }

}

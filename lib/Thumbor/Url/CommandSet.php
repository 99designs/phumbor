<?php

namespace Thumbor\Url;

/**
 * A set of image manipulation commands, roughly mirroring the interface
 * described at https://github.com/globocom/thumbor/wiki/Usage.
 */
class CommandSet
{
    private $trim;
    private $crop;
    private $resize;
    private $halign;
    private $valign;
    private $smartCrop = false;
    private $filters = array();
    private $metadataOnly = false;

    /**
     * Trim surrounding space from the thumbnail. The top-left corner of the
     * image is assumed to contain the background colour. To specify otherwise,
     * pass either 'top-left' or 'bottom-right' as the $colourSource argument.
     * For tolerance the euclidian distance between the colors of the reference pixel
     * and the surrounding pixels is used. If the distance is within the
     * tolerance they'll get trimmed. For a RGB image the tolerance would
     * be within the range 0-442
     */
    public function trim($colourSource = null, $tolerance = null)
    {
        $this->trim = 'trim';
        $this->trim .= $colourSource ? ":$colourSource" : '';
        $this->trim .= $tolerance ? ":$tolerance" : '';
    }

    /**
     * Manually specify crop window.
     */
    public function crop($topLeftX, $topLeftY, $bottomRightX, $bottomRightY)
    {
        $this->crop = "{$topLeftX}x{$topLeftY}:{$bottomRightX}x{$bottomRightY}";
    }

    /**
     * Resize the image to fit by smallest side in a box of the specified dimensions. 
     * Overrides any previous call to `fullFitIn`, `fitIn` or `resize`.
     */
    public function fullFitIn($width, $height)
    {
    	$this->resize = "full-fit-in/{$width}x{$height}";
    }
    
    /**
     * Resize the image to fit in a box of the specified dimensions. Overrides
     * any previous call to `fullFitIn`, `fitIn` or `resize`.
     */
    public function fitIn($width, $height)
    {
        $this->resize = "fit-in/{$width}x{$height}";
    }

    /**
     * Resize the image to the specified dimensions. Overrides any previous call
     * to `fullFitIn`, `fitIn` or `resize`.
     *
     * Use a value of 0 for proportional resizing. E.g. for a 640 x 480 image,
     * `->size(320, 0)` yields a 320 x 240 thumbnail.
     *
     * Use a value of 'orig' to use an original image dimension. E.g. for a 640
     * x 480 image, `->resize(320, 'orig')` yields a 320 x 480 thumbnail.
     */
    public function resize($width, $height)
    {
        $this->resize = "{$width}x{$height}";
    }

    /**
     * Specify horizontal alignment used if width is altered due to cropping
     * @param string $halign one of {'left', 'center', 'right'}
     */
    public function halign($halign)
    {
        $this->halign = $halign;
    }

    /**
     * Specify vertical alignment used if height is altered due to cropping
     * @param string $valign one of {'top', 'middle', 'bottom'}
     */
    public function valign($valign)
    {
        $this->valign = $valign;
    }

    /**
     * Specify that smart cropping should be used (overrides halign/valign).
     * @param bool $smartCrop
     */
    public function smartCrop($smartCrop)
    {
        $this->smartCrop = $smartCrop;
    }

    /**
     * Append a filter, e.g. `->addFilter('brightness', 42)`
     */
    public function addFilter(/*$filter, $args ...*/)
    {
        $args = func_get_args();
        $filter = array_shift($args);
        $this->filters []= sprintf('%s(%s)', $filter, implode(',', $args));
    }

    /**
     * Specify that JSON metadata should be returned instead of the thumbnailed
     * image.
     * @param bool $metadataOnly
     */
    public function metadataOnly($metadataOnly)
    {
        $this->metadataOnly = $metadataOnly;
    }

    /**
     * Stringify and return commands as an array.
     */
    public function toArray()
    {
        $commands = array();

        $maybeAppend = function ($command) use (&$commands) {
            if ($command) $commands []= (string) $command;
        };

        if ($this->metadataOnly) {
            $commands []= 'meta';
        }

        $maybeAppend($this->trim);
        $maybeAppend($this->crop);
        $maybeAppend($this->resize);
        $maybeAppend($this->halign);
        $maybeAppend($this->valign);

        if ($this->smartCrop) {
            $commands []= 'smart';
        }

        if (count($this->filters)) {
            $filters = 'filters:' . implode(':', $this->filters);
            $commands []= $filters;
        }

        return $commands;
    }
}

<?php
declare(strict_types=1);

namespace Less\View\Helper;

use Cake\Core\Exception\CakeException;
use Cake\View\Helper;

/**
 * LESS Helper
 */
class LessHelper extends Helper
{
    /**
     * List of helpers used by this helper
     *
     * @var array
     */
    protected array $helpers = [
        'Html'
    ];

    /**
     * Default configuration
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [
        'outputFolder' => 'ccss'
    ];


    /**
     * Returns CSS link of parsed LESS file
     * 
     * @var string $path Less file path
     * @var array $options Options
     * @return string CSS link
     * @throws CakeException When the path is missing
     */
    public function link(string $path, array $options = []): string
    {
        $defaults = [
            'minify' => true
        ];

        $options = array_merge($defaults, $options);

        if (!file_exists(ROOT . $path)) {
            throw new CakeException('LESS file missing: ' . ROOT . $path );
        }

        $filename = md5($path . filemtime(ROOT . $path)) . '.css';

        $cssFilename = $this->_defaultConfig['outputFolder'] . DS . $filename;

        if (file_exists(WWW_ROOT . $cssFilename)) {
            return $this->Html->css(DS . $cssFilename);
        }

        $parser = new \Less_Parser();

        try {
            $parser->parseFile(ROOT . $path, '/');
            $css = $parser->getCss();
        } catch (CakeException $e) {
            echo $e->getMessage();
        }

        try {
            file_put_contents(WWW_ROOT . $cssFilename, $css);
        } catch (CakeException $e) {
            echo $e->getMessage();
        }

        return $this->Html->css(DS . $cssFilename);
    }
}

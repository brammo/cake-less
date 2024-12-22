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
     * Returns CSS link tag of parsed LESS file
     * 
     * @var string $path Less file path
     * @var array $options Options
     * @return string CSS link tag
     * @throws CakeException When the LESS file is missing
     * @throws CakeException When the output folder is not writable
     */
    public function link(string $path, array $options = []): string
    {
        $defaults = [
            'minify' => true
        ];

        $options = array_merge($defaults, $options);

        // Check if the less file exists
        if (!file_exists(ROOT . $path)) {
            throw new CakeException('LESS file missing: ' . ROOT . $path );
        }

        // Generate CSS filename
        $filename = md5($path . filemtime(ROOT . $path)) . '.css';

        $outputFolder = $this->_defaultConfig['outputFolder'];
        $outputFolderPath = WWW_ROOT .  $outputFolder;
        $cssPath = DS . $outputFolder . DS . $filename;

        // If CSS file already exists then return the CSS path
        if (file_exists($outputFolderPath . DS . $filename)) {
            return $this->Html->css($cssPath);
        }

        // Check if output folder path is writable
        if (!is_writable($outputFolderPath)) {
            throw new CakeException('LESS folder is not writable: ' . $outputFolderPath );
        }

        // Parse LESS and get the result
        $parser = new \Less_Parser();
        $parser->parseFile(ROOT . $path, '/');
        $css = $parser->getCss();

        // Write CSS file
        file_put_contents($outputFolderPath . DS . $filename, $css);

        // Return CSS link tag 
        return $this->Html->css($cssPath);
    }
}

<?php
namespace Diff\Processor;

use Diff\FineDiff\FineDiff;

class AnalyseForm
{
    private $flText;

    private $prText;

    private $diffOpcodes;

    public function __construct()
    {
        $textBaseDir = getcwd() . DIRECTORY_SEPARATOR . 'texts';
        $flTextFile = $textBaseDir . DIRECTORY_SEPARATOR . $this->getActiveVersion() . '1.txt';
        $prTextFile = $textBaseDir . DIRECTORY_SEPARATOR . $this->getActiveVersion() . '2.txt';

        if ($this->isCorrectPost()) {
            $this->flText = $_POST['flText'];
        } elseif (file_exists($flTextFile)) {
            $this->flText = file_get_contents($flTextFile);
        }

        if ($this->isCorrectPost()) {
            $this->prText = $_POST['prText'];
        } elseif (file_exists($prTextFile)) {
            $this->prText = file_get_contents($prTextFile);
        }
    }

    public function isCorrectPost()
    {
        return isset($_POST['flText']) && isset($_POST['prText']) && isset($_POST['version']);
    }

    public function getFlText()
    {
        return $this->flText;
    }

    public function getPrText()
    {
        return $this->prText;
    }

    public static function isActiveVersion($version)
    {
        return (!empty($_REQUEST['version']) && ($_REQUEST['version'] == $version)) ||
        (empty($_REQUEST['version']) && $version == 'a');
    }

    public static function getActiveVersion()
    {
        return (!empty($_REQUEST['version']) && in_array($_REQUEST['version'], ['a', 'b'])) ? $_REQUEST['version'] : 'a';
    }

    public static function isActiveGranularity($granularity)
    {
        return (!empty($_POST['granularity']) && ($_POST['granularity'] == (int) $granularity)) ||
        (empty($_REQUEST['granularity']) && (int) $granularity == 0);
    }

    public static function getGranularity()
    {
        return (!empty($_POST['granularity'])) ? FineDiff::$characterGranularity : FineDiff::$wordGranularity;
    }


    public function compare()
    {
        $diff = new FineDiff($this->flText, $this->prText, $this->getGranularity());
        $this->diffOpcodes = $diff->getOps();
        return $diff->renderDiffToHTML();
    }
}

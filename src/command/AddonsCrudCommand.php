<?php

namespace shiyun\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Webman\Console\Util;

class AddonsCrudCommand extends Command
{
    protected static $defaultName = 'addons:crud';
    protected static $defaultDescription = 'Addons crud Create';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addOption('addons', 'addons', InputOption::VALUE_REQUIRED, ' addons name, for example test');
        $this->addOption('name', 'name', InputOption::VALUE_REQUIRED, 'crud name, for example role/effect');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $addons = strtolower($input->getOption('addons'));
        $output->writeln("Create Addons crud $addons");
        if (empty($addons)) {
            $output->writeln("<error> addons can not be empty</error>");
            return self::FAILURE;
        }
        $name = strtolower($input->getOption('name'));
        $output->writeln("Create Addons crud $name");
        if (empty($name)) {
            $output->writeln("<error> name can not be empty</error>");
            return self::FAILURE;
        }



        $this->createDir($addons);
        $this->createAll($addons, $name);

        return self::SUCCESS;
    }
    protected function createDir($addons)
    {
        $base_path = base_path();
        // if (!is_dir($plugin_config_path = base_path() . "/addons/$addons")) {
        $this->mkdir("$base_path/addons/$addons/config", 0777, true);
        $this->mkdir("$base_path/addons/$addons/controller", 0777, true);
        $this->mkdir("$base_path/addons/$addons/model", 0777, true);
        $this->mkdir("$base_path/addons/$addons/service", 0777, true);
        $this->mkdir("$base_path/addons/$addons/validate", 0777, true);
        // }
    }
    /**
     * @param $name
     * @return void
     */
    protected function createAll($addons, $name)
    {
        $base_path = base_path();
        $addons_path = "$base_path/addons/$addons";
        $name = trim($name, "/");
        if (str_contains($name, '/')) {
            $nameArr = explode("/", $name);
            $this->mkdir("$addons_path/controller/$nameArr[0]");
            $this->createControllerFile("$addons_path/controller/$nameArr[0]/$nameArr[1].php", $nameArr[1]);
        } else {
            $this->createControllerFile("$addons_path/controller/$name.php", $name);
            // $this->createFunctionsFile("$addons_path/app/functions.php");
            // $this->createViewFile("$addons_path/app/view/index/index.html");
            // $this->createExceptionFile("$addons_path/app/exception/Handler.php", $name);
        }
    }

    /**
     * @param $path
     * @return void
     */
    protected function mkdir($path)
    {
        if (is_dir($path)) {
            return;
        }
        echo "Create $path\r\n";
        mkdir($path, 0777, true);
    }
    protected function getStrNamespace($path = '')
    {
        $base_path = base_path();
        $file_name = strtolower(basename($path));
        $namespace_str = str_replace($base_path, '', $path);
        $namespace_str = str_replace($file_name, '', $namespace_str);
        $namespace_str = trim($namespace_str, '/');
        $namespace_str = str_replace("/", "\\", $namespace_str);
        return $namespace_str;
    }
    public function getStrClass($name = '')
    {
        return ucwords($name);
    }
    /**
     * @param $path
     * @param $name
     * @return void
     */
    protected function createControllerFile($path, $name)
    {
        $namespace = $this->getStrNamespace($path);
        $class = $this->getStrClass($name);

        $stub_path = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'controller.stub';
        $stub_content = '';
        $stub_content  = file_get_contents($stub_path);
        $stub_content = str_replace(['{%namespace%}', '{%className%}'], [
            $namespace,
            $class,
        ], $stub_content);
        file_put_contents($path, $stub_content);
    }

    /**
     * @param $path
     * @return void
     */
    protected function createViewFile($path)
    {
        $stub_content = '';
        file_put_contents($path, $stub_content);
    }

    /**
     * @param $path
     * @return void
     */
    protected function createExceptionFile($path, $name)
    {
        $stub_content = '';
        file_put_contents($path, $stub_content);
    }

    /**
     * @param $file
     * @return void
     */
    protected function createFunctionsFile($path)
    {
        $stub_content = '';
        file_put_contents($path, $stub_content);
    }
}

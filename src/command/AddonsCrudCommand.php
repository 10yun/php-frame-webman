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
        if (empty($addons)) {
            $output->writeln("<error> addons can not be empty</error>");
            return self::FAILURE;
        }
        $name = $input->getOption('name');

        $output->writeln("Create Addons = $addons ; crud = $name ");
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
            $name1 = strtolower($nameArr[0]);
            $name2 = $this->getStrClass($nameArr[1]);
            $name3 = "$name1/$name2";
            $this->mkdir("$addons_path/controller/$name1");
            $this->mkdir("$addons_path/model/$name1");
            $this->mkdir("$addons_path/service/$name1");
            $this->mkdir("$addons_path/validate/$name1");
        } else {
            $name2 = $this->getStrClass($name);
            $name3 = $name2;
        }
        $this->createControllerFile("$addons_path/controller/{$name3}Contlr.php", "{$name2}");
        $this->createModelFile("$addons_path/model/{$name3}Model.php", "{$name2}Model");
        $this->createValidateFile("$addons_path/validate/{$name3}Valida.php", "{$name2}Valida");
        $this->createRpcFile("$addons_path/service/{$name3}Rpc.php", "{$name2}Rpc");
        // $this->createFunctionsFile("$addons_path/app/functions.php");
        // $this->createViewFile("$addons_path/app/view/index/index.html");
        // $this->createExceptionFile("$addons_path/app/exception/Handler.php", $name);
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
        $file_name = basename($path);

        $namespace_str = str_replace($base_path, '', $path);
        $namespace_str = str_replace($file_name, '', $namespace_str);
        $namespace_str = trim($namespace_str, '/');
        $namespace_str = str_replace("/", "\\", $namespace_str);
        return $namespace_str;
    }
    protected function getStrClass($name = '')
    {
        return CommandUtils::camelizeEn(
            CommandUtils::camelizeUn($name)
        );
    }
    /**
     * @param $path
     * @param $name
     * @return void
     */
    protected function createControllerFile($path, $name)
    {
        if (!is_file($path)) {
            $namespace = $this->getStrNamespace($path);
            $class = $this->getStrClass($name . 'Contlr');

            $name2 = CommandUtils::camelizeUn($name);
            $flag_name =  "{$namespace}/$name2";
            $flag_name = str_replace('\\', "/", $flag_name);
            $flag_name = str_replace('addons', "", $flag_name);
            $flag_name = str_replace('controller', "", $flag_name);
            $flag_name = str_replace('//', "/", $flag_name);
            $flag_name = trim($flag_name, "/");

            $anno_flag = strtoupper(str_replace('/', "_", $flag_name));
            $anno_group = strtolower($flag_name);

            $stub_path = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'controller.stub';
            $stub_content = '';
            $stub_content  = file_get_contents($stub_path);
            $stub_content = str_replace(['{%namespace%}', '{%className%}', '{%annoFlag%}', '{%annoGroup%}'], [
                $namespace,
                $class,
                $anno_flag,
                $anno_group
            ], $stub_content);
            echo "Create {$namespace} \r\n";
            file_put_contents($path, $stub_content);
        }
    }
    protected function createModelFile($path, $name)
    {
        if (!is_file($path)) {
            $namespace = $this->getStrNamespace($path);
            $class = $this->getStrClass($name);

            $stub_path = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'model.stub';
            $stub_content = '';
            $stub_content  = file_get_contents($stub_path);
            $stub_content = str_replace(['{%namespace%}', '{%className%}'], [
                $namespace,
                $class,
            ], $stub_content);
            echo "Create {$namespace} \r\n";
            file_put_contents($path, $stub_content);
        }
    }

    protected function createValidateFile($path, $name)
    {
        if (!is_file($path)) {
            $namespace = $this->getStrNamespace($path);
            $class = $this->getStrClass($name);

            $stub_path = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'validate.stub';
            $stub_content = '';
            $stub_content  = file_get_contents($stub_path);
            $stub_content = str_replace(['{%namespace%}', '{%className%}'], [
                $namespace,
                $class,
            ], $stub_content);
            echo "Create {$namespace} \r\n";
            file_put_contents($path, $stub_content);
        }
    }
    protected function createRpcFile($path, $name)
    {
        if (!is_file($path)) {
            $namespace = $this->getStrNamespace($path);
            $class = $this->getStrClass($name);

            $stub_path = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'rpc.stub';
            $stub_content = '';
            $stub_content  = file_get_contents($stub_path);
            $stub_content = str_replace(['{%namespace%}', '{%className%}'], [
                $namespace,
                $class,
            ], $stub_content);
            echo "Create {$namespace} \r\n";
            file_put_contents($path, $stub_content);
        }
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

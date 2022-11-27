<?php

namespace shiyun\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Webman\Console\Util;

class AddonsCreateCommand extends Command
{
    protected static $defaultName = 'addons:create';
    protected static $defaultDescription = 'Addons Create';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'Addons name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln("Create Addons $name");

        if (str_contains($name, '/')) {
            $output->writeln('<error>Bad name, name must not contain character \'/\'</error>');
            return self::FAILURE;
        }
        // Create dir /addons/$name
        if (is_dir($plugin_config_path = base_path() . "/addons/$name")) {
            $output->writeln("<error>Dir $plugin_config_path already exists</error>");
            return self::FAILURE;
        }

        $this->createAll($name);

        return self::SUCCESS;
    }

    /**
     * @param $name
     * @return void
     */
    protected function createAll($name)
    {
        $base_path = base_path();
        $this->mkdir("$base_path/addons/$name/config", 0777, true);
        $this->mkdir("$base_path/addons/$name/controller", 0777, true);
        $this->mkdir("$base_path/addons/$name/model", 0777, true);
        $this->mkdir("$base_path/addons/$name/service", 0777, true);
        $this->mkdir("$base_path/addons/$name/validate", 0777, true);
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
}

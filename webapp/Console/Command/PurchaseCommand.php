<?php

namespace WebApp\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use WebApp\Entity\Item\Console;
use WebApp\Entity\Item\Controller;
use WebApp\Entity\Item\Microwave;
use WebApp\Entity\Item\Television;

use WebApp\Service\EntityItems;
use WebApp\Helper\Files;

class PurchaseCommand extends Command
{
    
    protected static $defaultName = 'command:purchase';

    protected function configure(): void
    {
        $this
            ->setDescription('Command for making purchases and displaying purchased items.')
            ->setHelp(
                'Runnig the command the purchases will be executed and the ordered list of ' . 
                'items and the total value will be displayed.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $console = new Console();
        $console->setType('Console');
        $console->setPrice(500);

        $controllerConsole = array(
            ['type' => 'controller', 'price' => 10, 'wired' => 'yes'],
            ['type' => 'controller', 'price' => 11, 'wired' => 'no'],
            ['type' => 'controller', 'price' => 12, 'wired' => 'yes'],
            ['type' => 'controller', 'price' => 10, 'wired' => 'no']
        );

        foreach ($controllerConsole as $extras) {
            if ($console->maxExtras()) {
                $controller = new Controller();
                
                $controller->setType($extras['type']);
                $controller->setPrice($extras['price']);
                $controller->setWired($extras['wired']);

                $console->setExtras($controller);
            } else {
                $output->writeln(sprintf(
                    "The extra %s with price $%s and wired '%s', can't be add because you achieved the limit of extra for console.", 
                    $extras['type'], 
                    number_format($extras['price'], 2, '.', ''), 
                    $extras['wired']
                ));
            }
        }

        $firstTv = new Television();
        $firstTv->setType('TV"');
        $firstTv->setPrice(450);

        $firstTvExtras = array(
            ['type' => 'controller', 'price' => 12.80, 'wired' => 'no'],
            ['type' => 'controller', 'price' => 12.80, 'wired' => 'no'],
        );

        foreach ($firstTvExtras as $extra) {
            if ($firstTv->maxExtras()) {
                $controller = new Controller();
                
                $controller->setType($extra['type']);
                $controller->setPrice($extra['price']);
                $controller->setWired($extra['wired']);

                $firstTv->setExtras($controller);
            } else {
                $output->writeln(sprintf(
                    "The extra %s with price $%s and wired '%s', can't be add because you achieved the limit of extra for television one.", 
                    $extra['type'], 
                    number_format($extra['price'], 2, '.', ''), 
                    $extra['wired']
                ));
            }
        }

        $secondTv = new Television();
        $secondTv->setType('TV');
        $secondTv->setPrice(320);
        
        $secondTvExtras = array(
            ['type' => 'controller', 'price' => 11, 'wired' => 'no'],
        );

        foreach ($secondTvExtras as $extra) {
            if ($secondTv->maxExtras()) {
                $controller = new Controller();
                
                $controller->setType($extra['type']);
                $controller->setPrice($extra['price']);
                $controller->setWired($extra['wired']);

                $secondTv->setExtras($controller);
            } else {
                $output->writeln(sprintf(
                    "The extra %s with price $%s and wired '%s', can't be add because you achieved the limit of extra for television two.", 
                    $extra['type'], 
                    number_format($extra['price'], 2, '.', ''), 
                    $extra['wired']
                ));
            }
        }

        $microwave = new Microwave();
        $microwave->setType('Microwave');
        $microwave->setPrice(100);

        $entityItems = new EntityItems([
            $console,
            $firstTv,
            $secondTv,
            $microwave
        ]);
        $sortedItems = $entityItems->getSortedItems();

        Files::writeFileSorted($sortedItems);

        $output->writeln(["<info>SALES REPORT</info>"]);
        $output->writeln(["<info>/////////////</info>"]);
        $output->writeln(["<comment>Total Price: </comment> $". $entityItems->getTotalPrice()]);
        $output->writeln(["<info>/////////////</info>"]);
        $output->writeln(["<question>Price of Console with Controllers: </question> $". $entityItems->getTotalPriceByType('Console')]);
        $output->writeln(["<info>/////////////</info>"]);
        $output->writeln(["<error>Go to /files/electronic_items_sorted.csv to take a look fo the items sorted</error>"]);

        return Command::SUCCESS;
    }
}
<?php

namespace App\Command;

use FOS\OAuthServerBundle\Model\ClientManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use FOS\OAuthServerBundle\Entity\ClientManager;

class AppOauthServerCreateClientCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:oauth-server:create-client';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDescription('Creates a new client')
            ->addOption(
                'redirect-uri',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets redirect uri for client. Use this option multiple times to set multiple redirect URIs.',
                null
            )
            ->addOption(
                'grant-type',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets allowed grant type for client. Use this option multiple times to set multiple grant types..',
                null
            )
            ->addOption(
                'client-id',
                null,
                InputOption::VALUE_REQUIRED,
                'Sets allowed grant type for client. Use this option multiple times to set multiple grant types..',
                null
            )
            ->addOption(
                'secret-id',
                null,
                InputOption::VALUE_REQUIRED,
                'Sets the client secret id',
                null
            )
            ->setHelp(
                <<<EOT
The <info>%command.name%</info> command creates a new client.
 <info>php %command.full_name% [--redirect-uri=...] [--grant-type=...]</info>
EOT
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Client Credentials');
        // Get the client manager
        /** @var ClientManagerInterface $clientManager */
        $clientManager = $this->getContainer()->get(ClientManager::class);
        // Create a new client
        $client = $clientManager->createClient();
        $client->setRedirectUris($input->getOption('redirect-uri'));
        $client->setAllowedGrantTypes($input->getOption('grant-type'));
        $client->setRandomId($input->getOption('client-id'));
        $client->setSecret($input->getOption('secret-id'));
        // Save the client
        $clientManager->updateClient($client);
        // Give the credentials back to the user
        $headers = ['Client ID', 'Client Secret'];
        $rows = [
            [$client->getPublicId(), $client->getSecret()],
        ];
        $io->table($headers, $rows);

        return 0;
    }
}

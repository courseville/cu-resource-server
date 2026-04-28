<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchSftpData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-sftp-data {--force : Force fetching data even in local or testing environments}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch CSV files from remote server via SFTP (Currently, hardcoded to only fetch DG Data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting SFTP data fetch...');

        if (app()->environment('testing', 'local') && ! $this->option('force')) {
            $this->info('Skipping SFTP fetch in testing or local environment. Use --force to override.');

            return 0;
        }

        // Executing the bash command as provided by the user
        // Note: This command assumes the existence of ~/dg-scripts and necessary credentials
        $bashCommand = "cd ~/dg-scripts && sshpass -f .dg_password sftp -o StrictHostKeyChecking=no -o LogLevel=ERROR eng-sftp@161.200.194.183 <<< $'lcd dg/\nmget DG*.csv\nbye'";

        $this->info('Executing bash command: '.$bashCommand);
        exec($bashCommand, $output, $returnVar);

        if ($returnVar !== 0) {
            $this->error('SFTP fetch failed with exit code: '.$returnVar);
            $this->error(implode("\n", $output));

            return 1;
        }

        $this->info('SFTP fetch completed successfully.');

        return 0;
    }
}

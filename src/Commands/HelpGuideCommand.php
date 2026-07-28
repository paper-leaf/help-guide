<?php

namespace PaperLeaf\HelpGuide\Commands;

use Illuminate\Console\Command;

class HelpGuideCommand extends Command
{
    public $signature = 'help-guide';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

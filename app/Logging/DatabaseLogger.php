<?php
namespace App\Logging;

use Monolog\Logger;
use Monolog\LogRecord;
use Monolog\Handler\AbstractProcessingHandler;
use App\Models\Log;

class DatabaseLogger
{
    public function __invoke(array $config)
    {
        return new Logger('database', [new class(Logger::DEBUG) extends AbstractProcessingHandler {
            public function __construct($level = Logger::DEBUG, bool $bubble = true)
            {
                parent::__construct($level, $bubble);
            }

            protected function write(LogRecord $record): void
            {
                if(!str_contains($record->message, 'persianapi') && $record->message !="Trying to access array offset on value of type null"){
                    Log::create([
                        'level' => $record->level->getName(),
                        'message' => $record->message,
                        'context' => json_encode($record->context),
                        'url'      => request()->fullUrl(),
                        'referrer' => request()->header('X-Referer-URL'),
                    ]);
                }

            }
        }]);
    }
}

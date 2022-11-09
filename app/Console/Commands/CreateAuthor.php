<?php

namespace App\Console\Commands;

use App\Http\Client\QClient;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class CreateAuthor extends Command
{
    private array $params = [
        'first_name' => '',
        'last_name' => '',
        'birthday' => '',
        'biography' => '',
        'place_of_birth' => '',
        'gender' => ''
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:author {--first_name=} {--last_name=} {--birthday=} {--gender=} {--place_of_birth=} {--biography=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new author';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(QClient $client)
    {
        try {
            $this->ensureDataExists();
        } catch (InvalidFormatException $exception) {
            $this->output->error('Error creating date from provided datetime.');
            return Command::FAILURE;
        }

        if ($this->params['gender'] != 'male' && $this->params['gender'] != 'female') {
            $this->output->error('Wrong gender. It should be male or female.');

            return Command::FAILURE;
        }

        $data = $client->authenticate(config('auth.default_user.email'), config('auth.default_user.password'));

        if (!$token = Arr::get($data, 'token_key', null)) {
            $this->output->error('Error authenticating.');

            return Command::FAILURE;
        }

        $author = $client->createAuthor($token, $this->params);

        if (!$author) {
            $this->output->error('Error creating author.');

            return Command::FAILURE;
        }

        $this->output->success('Author created.');
        return Command::SUCCESS;
    }

    private function ensureDataExists()
    {
        foreach ($this->params as $key => $param) {
            if ($param != 'birthday' && !($this->params[$key] = $this->option($key))) {
                $this->params[$key] = $this->ask("Please enter $key:");
                continue;
            }


            if (!$this->option($key)) {
                $date = $this->ask("Please enter $key in format yyyy-mm-dd Y-m-d H:i:s");
                $this->params[$key] = Carbon::createFromFormat('Y-m-d H:i:s', $date);
                continue;
            }

            $this->params[$key] = Carbon::createFromFormat('Y-m-d H:i:s', $this->option($key));
        }
    }
}

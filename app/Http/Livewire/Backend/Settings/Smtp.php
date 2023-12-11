<?php

namespace App\Http\Livewire\Backend\Settings;

use Livewire\Component;

class Smtp extends Component {

    /**
     * Components State
     */
    public $state = [
        'smtp' => [
            'host' => '',
            'port' => '',
            'username' => '',
            'password' => '',
            'encryption' => '',
            'from' => [
                'address' => '',
                'name' => '',
            ],
        ]
    ];

    public function mount() {
        $this->state = [
            'smtp' => [
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'username' => config('mail.mailers.smtp.username'),
                'password' => config('mail.mailers.smtp.password'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'from' => config('mail.from'),
            ]
        ];
    }

    public function update() {
        $this->changeEnv([
            'MAIL_MAILER' => 'smtp',
            'MAIL_HOST' => $this->state['smtp']['host'],
            'MAIL_PORT' => $this->state['smtp']['port'],
            'MAIL_USERNAME' => $this->state['smtp']['username'],
            'MAIL_PASSWORD' => $this->state['smtp']['password'],
            'MAIL_ENCRYPTION' => $this->state['smtp']['encryption'],
            'MAIL_FROM_ADDRESS' => $this->state['smtp']['from']['address'],
            'MAIL_FROM_NAME' => $this->state['smtp']['from']['name'],
        ]);
        $this->emit('saved');
    }

    public function render() {
        return view('backend.settings.smtp');
    }

    /** Save Details to env file */
    private function changeEnv($data = array()) {
        if (count($data) > 0) {
            $env = file_get_contents(base_path() . '/.env');
            $env = explode("\n", $env);
            foreach ((array)$data as $key => $value) {
                $notfound = true;
                foreach ($env as $env_key => $env_value) {
                    $entry = explode("=", $env_value, 2);
                    if ($entry[0] == $key) {
                        $env[$env_key] = $key . "=\"" . $value . "\"";
                        $notfound = false;
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }
                if ($notfound) {
                    $env[$env_key + 1] = "\n" . $key . "=\"" . $value . "\"";
                }
            }
            $env = implode("\n", $env);
            file_put_contents(base_path() . '/.env', $env);
            return true;
        } else {
            return false;
        }
    }
}

<?php

namespace Modules\Ticket\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Repositories\TicketRepository;
use Modules\User\Entities\User;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        /** @var TicketRepository $repository */
        $repository = app(TicketRepository::class);
        return [
            "title"       => $this->faker->title,
            "description" => $this->faker->text,
            "status"      => Ticket::getAllStatuses()[array_rand(Ticket::getAllStatuses())],
            "code"        => Ticket::generateCode($repository),
            "user_id"     => User::query()->inRandomOrder()->first()->id,
            "closed"      => $this->faker->boolean(10),
        ];
    }
}


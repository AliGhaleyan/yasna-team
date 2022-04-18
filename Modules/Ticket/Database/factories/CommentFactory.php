<?php

namespace Modules\Ticket\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ticket\Entities\Comment;
use Modules\Ticket\Entities\Ticket;
use Modules\User\Entities\User;
use Modules\User\Utils\Roles;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "text"      => $this->faker->text,
            "user_id"   => User::role(Roles::SUPPORT)->inRandomOrder()->first()->id,
            "ticket_id" => Ticket::query()->inRandomOrder()->first()->id,
        ];
    }
}


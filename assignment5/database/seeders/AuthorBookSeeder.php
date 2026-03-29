<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class AuthorBookSeeder extends Seeder
{
    /**
     * Seed the authors and books tables.
     * 3 authors, each with at least 2 books.
     */
    public function run(): void
    {
        $authorsData = [
            [
                'name' => 'Jane Austen',
                'email' => 'jane.austen@example.com',
                'books' => [
                    ['title' => 'Pride and Prejudice', 'description' => 'A romantic novel of manners that critiques the British landed gentry at the end of the 18th century.'],
                    ['title' => 'Sense and Sensibility', 'description' => 'A novel about two sisters and their romantic struggles.'],
                    ['title' => 'Emma', 'description' => 'A comedy of manners about the perils of misconstrued romance.'],
                ],
            ],
            [
                'name' => 'George Orwell',
                'email' => 'george.orwell@example.com',
                'books' => [
                    ['title' => '1984', 'description' => 'A dystopian social science fiction novel about totalitarianism and surveillance.'],
                    ['title' => 'Animal Farm', 'description' => 'An allegorical novella about the Russian Revolution and totalitarianism.'],
                    ['title' => 'Homage to Catalonia', 'description' => 'A personal account of Orwell\'s experiences in the Spanish Civil War.'],
                ],
            ],
            [
                'name' => 'Agatha Christie',
                'email' => 'agatha.christie@example.com',
                'books' => [
                    ['title' => 'Murder on the Orient Express', 'description' => 'A detective novel featuring Hercule Poirot investigating a murder on a train.'],
                    ['title' => 'Death on the Nile', 'description' => 'A mystery novel set in Egypt with Poirot solving a murder.'],
                    ['title' => 'The Murder of Roger Ackroyd', 'description' => 'A landmark mystery novel known for its innovative narrative twist.'],
                ],
            ],
        ];

        foreach ($authorsData as $data) {
            $author = Author::create([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            foreach ($data['books'] as $bookData) {
                Book::create([
                    'title' => $bookData['title'],
                    'description' => $bookData['description'],
                    'author_id' => $author->id,
                ]);
            }
        }
    }
}

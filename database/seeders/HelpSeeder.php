<?php

namespace Database\Seeders;

use App\Models\Help;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HelpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Help::create([
            'id' => 2,
            'categories' => 'Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC',
            'title' => 'Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC',
            'content' => '<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>',
            'created_by' => 6,
            'created_at' => '2023-10-11 19:48:45',
            'updated_at' => '2023-10-11 19:48:45',
        ]);
        Help::create([
            'id' => 3,
            'categories' => '1914 translation by H. Rackham',
            'title' => '1914 translation by H. Rackham',
            'content' => '<p>\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"</p>',
            'created_by' => 6,
            'created_at' => '2023-10-11 19:50:00',
            'updated_at' => '2023-10-11 19:50:00',
        ]);
        Help::create([
            'id' => 4,
            'categories' => 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC',
            'title' => 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC',
            'content' => '<p>\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"</p>',
            'created_by' => 6,
            'created_at' => '2023-10-11 19:51:00',
            'updated_at' => '2023-10-11 19:51:00',
        ]);
        Help::create([
            'id' => 5,
            'categories' => 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC',
            'title' => 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC',
            'content' => '<p>\"Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"</p>',
            'created_by' => 6,
            'created_at' => '2023-10-11 19:52:00',
            'updated_at' => '2023-10-11 19:52:00',
        ]);
        Help::create([
            'id' => 6,
            'categories' => 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC',
            'title' => 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC',
            'content' => '<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>',
            'created_by' => 6,
            'created_at' => '2023-10-11 19:53:00',
            'updated_at' => '2023-10-11 19:53:00',
        ]);
    }
}

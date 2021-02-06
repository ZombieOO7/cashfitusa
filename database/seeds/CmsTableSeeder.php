<?php

use Illuminate\Database\Seeder;

class CmsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms')->delete();
        
        \DB::table('cms')->insert(array (
            0 => 
            array (
                'uuid' => '0d904ecd-6ac2-4b06-b33d-9610744dbcb1',
                'page_title' => 'Terms & Conditions',
                'page_slug' => 'terms-conditions',
                'api_page_slug' => NULL,
                'page_content' => '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>',
                'meta_title' => NULL,
                'meta_keyword' => 'Lorem Ipsum',
                'meta_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-02-24 08:59:12',
                'updated_at' => '2020-02-24 08:59:12',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'uuid' => 'c3ce9053-7ad1-4095-8225-3f20de6d9877',
                'page_title' => 'About us',
                'page_slug' => 'about-us',
                'api_page_slug' => NULL,
                'page_content' => '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>',
                'meta_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-02-24 08:59:46',
                'updated_at' => '2020-02-24 08:59:46',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'uuid' => '74f746b6-42d7-4a5f-a550-d04443b72f61',
                'page_title' => 'Privacy Policy',
                'page_slug' => 'privacy-policy',
                'api_page_slug' => NULL,
                'page_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum nunc mi, in accumsan nulla maximus a. Morbi eleifend sem dolor, eu mattis orci molestie non. Pellentesque tristique ligula tortor. Suspendisse potenti. Pellentesque luctus enim at convallis mattis. Nunc euismod sagittis odio sed fringilla. Morbi non diam ut dui posuere vehicula. Vivamus lorem nunc, lobortis quis ultrices vel, aliquam scelerisque justo. Vivamus sapien nunc, dapibus non porta ac, accumsan non enim. Nulla eget dui maximus diam semper gravida sed nec lectus. Praesent consequat massa at massa auctor, ut fermentum libero tempor.&nbsp;</p>',
                'meta_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-02-25 13:15:20',
                'updated_at' => '2020-02-26 07:04:15',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'uuid' => 'b7cbd6b7-d1da-4918-8c50-5b61674456c8',
                'page_title' => 'Identification',
                'page_slug' => 'identification',
                'api_page_slug' => NULL,
                'page_content' => '<p><em>Lorem ipsum</em>, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>',
                'meta_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_robots' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => '2020-10-10 11:08:08',
                'updated_at' => '2020-10-10 11:08:08',
                'deleted_at' => NULL,
            ),
        ));
    }
}
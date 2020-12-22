<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $role1=Role::create(['name' =>'SuperAdmin']);
        $role2=Role::create(['name' =>'ادمن']);
        $role3=Role::create(['name' =>'كاتب']);
        $role4=Role::create(['name' =>'مشترك']);
        $role5=Role::create(['name' =>'رئيس قسم']);
        $role6=Role::create(['name' =>'رئيس التحرير']);

        $permissions[]=Permission::create(['name' => 'الاقسام']);
        $permissions[]=Permission::create(['name' => 'انشاء قسم']);
        $permissions[]=Permission::create(['name' => 'مشاهد قسم']);
        $permissions[]=Permission::create(['name' => 'تعديل قسم']);
        $permissions[]=Permission::create(['name' => 'حذف قسم']);
        $permissions[]=Permission::create(['name' => 'تفعيل قسم']);
        $permissions[]=Permission::create(['name' => 'تعطيل قسم']);
        $permissions[]=Permission::create(['name' => 'المقالات']);
        $permissions[]=Permission::create(['name' => 'انشاء مقال']);
        $permissions[]=Permission::create(['name' => 'مشاهد مقال']);
        $permissions[]=Permission::create(['name' => 'تعديل مقال']);
        $permissions[]=Permission::create(['name' => 'حذف مقال']);
        $permissions[]=Permission::create(['name' => 'نشر مقال']);
        $permissions[]=Permission::create(['name' => 'الغاء نشر مقال']);
        $permissions[]=Permission::create(['name' => 'الكتاب']);
        $permissions[]=Permission::create(['name' => 'رؤساء الاقسام']);
        $permissions[]=Permission::create(['name' => 'المشتركين']);
        $permissions[]=Permission::create(['name' => 'انشاء كاتب']);
        $permissions[]=Permission::create(['name' => 'تعديل الموقع']);

        Category::create(['name'=>'رياضة']);
        Category::create(['name'=>'فن']);
        Category::create(['name'=>'سياسة']);
        Category::create(['name'=>'اقتصاد']);
        Category::create(['name'=>'ابراج']);
        Category::create(['name'=>'شباب']);
        $data= [
            'name' => 'Mohamed Frouh',
            'email' => 'mohamedfrouh'.'@example.com',
            'email_verified_at' => now(),
            'status'=>'active',
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ];
         $user=User::create($data);
         $user->assignRole($role1);
        // for ($i=0; $i <200 ; $i++) {
        // $data= [
        //     'name' => 'Mohamed Frouh'.$i,
        //     'email' => 'mohamedfrouh'.$i.'@example.com',
        //     'email_verified_at' => now(),
        //     'status'=>'active',
        //     'password' => bcrypt('12345678'),
        //     'remember_token' => Str::random(10),
        // ];
        //  $user=User::create($data);
        // if ($i==0) {
        //     $user->assignRole($role1);
        // }
        // if ($i==1) {
        //     $user->assignRole($role2);
        // }
        // if ($i!=1 && $i<100) {
        //     $user->assignRole($role3);
        //     $user->categories()->sync([rand(1,6)]);
        // }
        // if ($i>=100) {
        //     $user->assignRole($role4);
        // }
        // }

        // Tag::create(['name'=>'name1']);
        // Tag::create(['name'=>'name2']);
        // Tag::create(['name'=>'name3']);
        // Tag::create(['name'=>'name4']);
        // Tag::create(['name'=>'name5']);
        // for ($i=1; $i < 501; $i++) {
        // $dataarticle= [
        //     'image' => 'storage/articles/1.png',
        //     'title' => 'Article '.$i,
        //     'slug' => 'Article_'.$i,
        //     'status'=>'publish',
        //     'content' => 'Article_'.$i,
        //     'user_id' =>rand(2,99),
        // ];
        // $article=Article::create($dataarticle);
        // $article->categories()->sync([rand(1,6)]);
        // $article->tags()->sync([rand(1,5)]);

        // }



    }
}

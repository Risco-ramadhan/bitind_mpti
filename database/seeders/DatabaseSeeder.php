<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\OrderSection;
use App\Models\Product;
use App\Models\Revision;
use App\Models\SalesTransaction;
use App\Models\Timeline;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;
use PhpParser\Node\Expr\Cast\Array_;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
        $countries = array(
            // array('code' => 'US', 'name' => 'United States'),
            // array('code' => 'CA', 'name' => 'Canada'),
            // array('code' => 'AF', 'name' => 'Afghanistan'),
            // array('code' => 'AL', 'name' => 'Albania'),
            // array('code' => 'DZ', 'name' => 'Algeria'),
            // array('code' => 'AS', 'name' => 'American Samoa'),
            // array('code' => 'AD', 'name' => 'Andorra'),
            // array('code' => 'AO', 'name' => 'Angola'),
            // array('code' => 'AI', 'name' => 'Anguilla'),
            // array('code' => 'AQ', 'name' => 'Antarctica'),
            // array('code' => 'AG', 'name' => 'Antigua and/or Barbuda'),
            // array('code' => 'AR', 'name' => 'Argentina'),
            // array('code' => 'AM', 'name' => 'Armenia'),
            // array('code' => 'AW', 'name' => 'Aruba'),
            // array('code' => 'AU', 'name' => 'Australia'),
            // array('code' => 'AT', 'name' => 'Austria'),
            // array('code' => 'AZ', 'name' => 'Azerbaijan'),
            // array('code' => 'BS', 'name' => 'Bahamas'),
            // array('code' => 'BH', 'name' => 'Bahrain'),
            // array('code' => 'BD', 'name' => 'Bangladesh'),
            // array('code' => 'BB', 'name' => 'Barbados'),
            // array('code' => 'BY', 'name' => 'Belarus'),
            // array('code' => 'BE', 'name' => 'Belgium'),
            // array('code' => 'BZ', 'name' => 'Belize'),
            // array('code' => 'BJ', 'name' => 'Benin'),
            // array('code' => 'BM', 'name' => 'Bermuda'),
            // array('code' => 'BT', 'name' => 'Bhutan'),
            // array('code' => 'BO', 'name' => 'Bolivia'),
            // array('code' => 'BA', 'name' => 'Bosnia and Herzegovina'),
            // array('code' => 'BW', 'name' => 'Botswana'),
            // array('code' => 'BV', 'name' => 'Bouvet Island'),
            // array('code' => 'BR', 'name' => 'Brazil'),
            // array('code' => 'IO', 'name' => 'British lndian Ocean Territory'),
            // array('code' => 'BN', 'name' => 'Brunei Darussalam'),
            // array('code' => 'BG', 'name' => 'Bulgaria'),
            // array('code' => 'BF', 'name' => 'Burkina Faso'),
            // array('code' => 'BI', 'name' => 'Burundi'),
            // array('code' => 'KH', 'name' => 'Cambodia'),
            // array('code' => 'CM', 'name' => 'Cameroon'),
            // array('code' => 'CV', 'name' => 'Cape Verde'),
            // array('code' => 'KY', 'name' => 'Cayman Islands'),
            // array('code' => 'CF', 'name' => 'Central African Republic'),
            // array('code' => 'TD', 'name' => 'Chad'),
            // array('code' => 'CL', 'name' => 'Chile'),
            // array('code' => 'CN', 'name' => 'China'),
            // array('code' => 'CX', 'name' => 'Christmas Island'),
            // array('code' => 'CC', 'name' => 'Cocos (Keeling) Islands'),
            // array('code' => 'CO', 'name' => 'Colombia'),
            // array('code' => 'KM', 'name' => 'Comoros'),
            // array('code' => 'CG', 'name' => 'Congo'),
            // array('code' => 'CK', 'name' => 'Cook Islands'),
            // array('code' => 'CR', 'name' => 'Costa Rica'),
            // array('code' => 'HR', 'name' => 'Croatia (Hrvatska)'),
            // array('code' => 'CU', 'name' => 'Cuba'),
            // array('code' => 'CY', 'name' => 'Cyprus'),
            // array('code' => 'CZ', 'name' => 'Czech Republic'),
            // array('code' => 'CD', 'name' => 'Democratic Republic of Congo'),
            // array('code' => 'DK', 'name' => 'Denmark'),
            // array('code' => 'DJ', 'name' => 'Djibouti'),
            // array('code' => 'DM', 'name' => 'Dominica'),
            // array('code' => 'DO', 'name' => 'Dominican Republic'),
            // array('code' => 'TP', 'name' => 'East Timor'),
            // array('code' => 'EC', 'name' => 'Ecudaor'),
            // array('code' => 'EG', 'name' => 'Egypt'),
            // array('code' => 'SV', 'name' => 'El Salvador'),
            // array('code' => 'GQ', 'name' => 'Equatorial Guinea'),
            // array('code' => 'ER', 'name' => 'Eritrea'),
            // array('code' => 'EE', 'name' => 'Estonia'),
            // array('code' => 'ET', 'name' => 'Ethiopia'),
            // array('code' => 'FK', 'name' => 'Falkland Islands (Malvinas)'),
            // array('code' => 'FO', 'name' => 'Faroe Islands'),
            // array('code' => 'FJ', 'name' => 'Fiji'),
            // array('code' => 'FI', 'name' => 'Finland'),
            // array('code' => 'FR', 'name' => 'France'),
            // array('code' => 'FX', 'name' => 'France, Metropolitan'),
            // array('code' => 'GF', 'name' => 'French Guiana'),
            // array('code' => 'PF', 'name' => 'French Polynesia'),
            // array('code' => 'TF', 'name' => 'French Southern Territories'),
            // array('code' => 'GA', 'name' => 'Gabon'),
            // array('code' => 'GM', 'name' => 'Gambia'),
            // array('code' => 'GE', 'name' => 'Georgia'),
            // array('code' => 'DE', 'name' => 'Germany'),
            // array('code' => 'GH', 'name' => 'Ghana'),
            // array('code' => 'GI', 'name' => 'Gibraltar'),
            // array('code' => 'GR', 'name' => 'Greece'),
            // array('code' => 'GL', 'name' => 'Greenland'),
            // array('code' => 'GD', 'name' => 'Grenada'),
            // array('code' => 'GP', 'name' => 'Guadeloupe'),
            // array('code' => 'GU', 'name' => 'Guam'),
            // array('code' => 'GT', 'name' => 'Guatemala'),
            // array('code' => 'GN', 'name' => 'Guinea'),
            // array('code' => 'GW', 'name' => 'Guinea-Bissau'),
            // array('code' => 'GY', 'name' => 'Guyana'),
            // array('code' => 'HT', 'name' => 'Haiti'),
            // array('code' => 'HM', 'name' => 'Heard and Mc Donald Islands'),
            // array('code' => 'HN', 'name' => 'Honduras'),
            // array('code' => 'HK', 'name' => 'Hong Kong'),
            // array('code' => 'HU', 'name' => 'Hungary'),
            // array('code' => 'IS', 'name' => 'Iceland'),
            // array('code' => 'IN', 'name' => 'India'),
            array('code' => 'ID', 'name' => 'Indonesia'),
        );

        Country::insert($countries);

        $this->call([
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            // VillagesSeeder::class,
        ]);
        User::factory(10)->create();

        $product = [
            [
                'id'                  => 1,
                'category_id'         => 1,
                'package_name'        => 'Water',
                'price'               => 450000,
                'cost'                => 300000,
                'tax'                 => '10%',
                'product_image'       => '/img/Vector1.png',
                'font_color'          => '#000000',
                'color'               => '#51A9FC',
                'product_description' => '2 Page <br>1 Landing Page <br>1 Link Tree Page <br>Content Management <br>1 Domain <br>20 Mb Storage <br>1 Time Correction',
                'status'              => 1,
            ],
            [
                'id'                  => 2,
                'category_id'         => 1,
                'package_name'        => 'Syrup',
                'price'               => 650000,
                'cost'                => 300000,
                'tax'                 => '10%',
                'product_image'       => '/img/Vector2.png',
                'font_color'          => '#000000',
                'color'               => '#FCD651',
                'product_description' => '4 Page <br>1 Landing Page <br>2 Blog and detail Page <br>1 Link Tree Page <br>Content Management <br>1 Domain <br>50 Mb Storage <br>3 Time Correction',
                'status'              => 1,
            ],
            [
                'id'                  => 3,
                'category_id'         => 1,
                'package_name'        => 'Coke',
                'price'               => 1050000,
                'cost'                => 300000,
                'tax'                 => '10%',
                'product_image'       => '/img/Vector3.png',
                'font_color'          => '#ffffff',
                'color'               => '#2F1900',
                'product_description' => '6 Page <br>1 Landing Page <br>2 Blog and detail Page <br> 2 Product and detail Page<br> 1 Link Tree Page <br>Content Management <br>1 Domain <br>100 Mb Storage <br>6 Time Correction',
                'status'              => 1,
            ]
        ];

        Product::insert($product);

        OrderSection::factory(10)->create();
        $faker = Faker::create();
        // SalesTransaction::factory(10)->create();

        $salestransaction = [
            [
                'id'                => 1,
                'orderid'           => 1,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 2,
                'orderid'           => 2,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 3,
                'orderid'           => 3,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 4,
                'orderid'           => 4,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 5,
                'orderid'           => 5,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 6,
                'orderid'           => 6,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 7,
                'orderid'           => 7,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 8,
                'orderid'           => 8,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 9,
                'orderid'           => 9,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'id'                => 10,
                'orderid'           => 10,
                'status_pembayaran' => $temp = $faker->boolean($chanceOfGettingTrue = 50),
                'status_product'    => ($temp == 1) ? TRUE : FALSE,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
        ];

        SalesTransaction::insert($salestransaction);

        Timeline::factory(10)->create();

        Revision::factory(10)->create();
    }
}

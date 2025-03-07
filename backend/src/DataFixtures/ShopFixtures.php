<?php

namespace App\DataFixtures;

use App\Entity\CategoryShop;
use App\Entity\Shop;
use App\Entity\City;
use App\Entity\Merchant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ShopFixtures extends Fixture implements DependentFixtureInterface
{
    public const SHOP_REFERENCE = 'shop-';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Exemples de CategoryShop
        $logoUrl = [
            'https://img.freepik.com/vecteurs-libre/facade-boutique-panneau_1441-2740.jpg?t=st=1741192792~exp=1741196392~hmac=b4ffcd95e030f90f902ebc2b98d48db8519690a275885ebd8ca4e83a4c9543d2&w=1380',
            'https://img.freepik.com/vecteurs-libre/deodorant-bouteilles-parfum-velours-vortex-toile-fond-soie_33099-1548.jpg?t=st=1741354187~exp=1741357787~hmac=1a6bc1493088ef43f39ecb98bc7f8f4a92f0c6a59ea045b87807bffafa3e911f&w=2000',
            'https://img.freepik.com/vecteurs-libre/fond-rose-brillant-produits-cosmetiques-hydratants_1441-228.jpg?t=st=1741354044~exp=1741357644~hmac=5a45a4c52823c6017ca64d82eb8f26041b9f41781ba1203f4a9ed9f4e285b620&w=2000',
            'https://img.freepik.com/vecteurs-libre/maquette-interieur-du-cafe-comptoir-bar-vide-tables-chaises-lampes-plafond_1441-2563.jpg?t=st=1741353596~exp=1741357196~hmac=33351598f88f3cf93ac2f2b5818c74c0f2f6ac8b917a54933f606767405ce27a&w=1380',
            'https://img.freepik.com/vecteurs-libre/vue-perspective-allee-du-supermarche_107791-19303.jpg?t=st=1741354310~exp=1741357910~hmac=742767b5b83a7dfc0ef7c7ee1b5be28f98e81403fb9aa48df75df83613552eaa&w=1380',
            'https://img.freepik.com/vecteurs-libre/produit-huile-realiste-colore-arbre-the-noix-coco-bouteilles-huile-arachide_1284-54789.jpg?t=st=1741354302~exp=1741357902~hmac=07e21a1122be00e8eeeb0a335fedd8e17c89dbbd5f3b9202f35ae384ce92f45d&w=1380',
            'https://img.freepik.com/vecteurs-libre/podium-bois-3d-piedestal-affichage-produits-bois_107791-29016.jpg?t=st=1741354301~exp=1741357901~hmac=8687c28e80b4cb21fadba47c65f7e7f30fa19a95fee711ecf0f0f9245900a764&w=1380',
            'https://img.freepik.com/vecteurs-libre/plateformes-bois-fond-mur-beige-ombre-plante-illustration-vectorielle-realiste-podiums-bois-naturel-pour-presentation-produits-maquette-piedestal-forme-ronde-publicite-pour-cosmetiques-biologiques_107791-24234.jpg?t=st=1741354266~exp=1741357866~hmac=c1cc163ceb4e6e4cd90a666a9fd313634c509e58ea48894f7b78262c63b5931a&w=1380'
        ];

        for ($i = 0; $i < 20; $i++) {
            $shop = new Shop();
            $shop->setName($faker->company);
            $shop->setLogo($logoUrl[$faker->numberBetween(0, 7)]);
            $shop->setSiret($faker->numberBetween(10000000000000, 99999999999999));
            $shop->setAddress($faker->address);
            $shop->setLongitude($faker->longitude);
            $shop->setLatitude($faker->latitude);
            $shop->setPhone($faker->randomNumber(9, true));
            $shop->setCreationDate(new \DateTime());
            $shop->setStatus($faker->randomElement(['active', 'inactive']));

            // Gestion du compte PayPal
            if ($faker->boolean(50)) { // 50% de chance d'avoir un compte PayPal
                $shop->setPaypalAccount($faker->email);
                $shop->setPaypalId($faker->uuid);
            } else {
                $shop->setPaypalAccount(null);
                $shop->setPaypalId(null);
            }

            $shop->setType($faker->randomElement([\App\Config\TypeShop::RESTAURANT, \App\Config\TypeShop::MAGASIN]));

            $cityReference = CityFixtures::CITY_REFERENCE . $faker->numberBetween(0, 3);
            if ($this->hasReference($cityReference, City::class)) {
                $shop->setCity($this->getReference($cityReference, City::class));
            }

            $merchantReference = UsersFixtures::MERCHANT_REFERENCE . $faker->numberBetween(0, 2);
            if ($this->hasReference($merchantReference, Merchant::class)) {
                $shop->setMerchantId($this->getReference($merchantReference, Merchant::class));
            } 

            $categoryReference = CategoryShopFixtures::CATEGORYSHOP_REFERENCE . $faker->numberBetween(0, 9);
            if ($this->hasReference($categoryReference, CategoryShop::class)) {
                $shop->addCategory($this->getReference($categoryReference, CategoryShop::class));
            } 

            $manager->persist($shop);

            $this->addReference(self::SHOP_REFERENCE . $i, $shop);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CityFixtures::class,
            UsersFixtures::class,
            CategoryShopFixtures::class
        ];
    }
}
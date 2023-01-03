<?php

namespace Database\Factories;

use App\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FileFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        $images = [
            'IMG_0004.jpg',
            'IMG_0073.jpg',
            'IMG_0084.jpg',
            'IMG_0089.jpg',
            'IMG_0091.jpg',
            'IMG_0097.jpg',
            'IMG_0105.jpg',
            'IMG_0106.jpg',
            'IMG_0115.jpg',
            'IMG_0134.jpg',
            'IMG_0139.jpg',
            'IMG_0140.jpg',
            'IMG_0147.jpg',
            'IMG_0152.jpg',
            'IMG_0158.jpg',
            'IMG_0166.jpg',
            'IMG_0169.jpg',
            'IMG_0172.jpg',
            'IMG_0173.jpg',
            'IMG_0185.jpg',
            'IMG_0187.jpg',
            'IMG_0197.jpg',
            'IMG_0203.jpg',
            'IMG_0205.jpg',
            'IMG_0209.jpg',
            'IMG_0212.jpg',
            'IMG_0216.jpg',
            'IMG_0220.jpg',
            'IMG_0225.jpg',
            'IMG_0227.jpg',
            'IMG_0230.jpg',
            'IMG_0250.jpg',
            'IMG_0253.jpg',
            'IMG_0254.jpg',
            'IMG_0256.jpg',
            'IMG_0257.jpg',
            'IMG_0258.jpg',
            'IMG_0260.jpg',
            'IMG_0262.jpg',
            'IMG_0263-2.jpg',
            'IMG_0268.jpg',
            'IMG_0276.jpg',
            'IMG_0285.jpg',
            'IMG_0288.jpg',
            'IMG_0293.jpg',
            'IMG_0298.jpg',
            'IMG_0319.jpg',
            'IMG_0322.jpg',
            'IMG_0324.jpg',
            'IMG_0328.jpg',
            'IMG_0333.jpg',
            'IMG_0334.jpg',
            'IMG_0335.jpg',
            'IMG_0338.jpg',
            'IMG_0349.jpg',
            'IMG_0367.jpg',
            'IMG_0368.jpg',
            'IMG_0373.jpg',
            'IMG_0378.jpg',
            'IMG_0379.jpg',
            'IMG_0380.jpg',
            'IMG_0381.jpg',
            'IMG_0382.jpg',
            'IMG_0387.jpg',
            'IMG_0391.jpg',
            'IMG_0392.jpg',
            'IMG_0394.jpg',
            'IMG_0395.jpg',
            'IMG_0396.jpg',
            'IMG_0398.jpg',
            'IMG_0401.jpg',
            'IMG_0404.jpg',
            'IMG_0406.jpg',
            'IMG_0407.jpg',
            'IMG_0411.jpg',
            'IMG_0412.jpg',
            'IMG_0414.jpg',
            'IMG_0415.jpg',
            'IMG_0420.jpg',
            'IMG_0424.jpg',
            'IMG_0426.jpg',
            'IMG_0427.jpg',
            'IMG_0434.jpg',
            'IMG_0436.jpg',
            'IMG_0438.jpg',
            'IMG_0440.jpg',
            'IMG_0443.jpg',
            'IMG_0445.jpg',
            'IMG_0449.jpg',
            'IMG_0451.jpg',
            'IMG_0470.jpg',
            'IMG_0474.jpg',
            'IMG_0478.jpg',
            'IMG_0479.jpg',
            'IMG_0481.jpg',
            'IMG_0482.jpg',
            'IMG_0483.jpg',
            'IMG_0485.jpg',
            'IMG_0486.jpg',
            'IMG_0487.jpg',
            'IMG_0488.jpg',
            'IMG_0489.jpg',
            'IMG_0490.jpg',
            'IMG_0491.jpg',
            'IMG_0492.jpg',
            'IMG_0495.jpg',
            'IMG_0500.jpg',
            'IMG_0521.jpg',
            'IMG_0525.jpg',
            'IMG_0527.jpg',
            'IMG_0532-2.jpg',
            'IMG_0532.jpg',
            'IMG_0534.jpg',
            'IMG_0537.jpg',
            'IMG_0539.jpg',
            'IMG_0540.jpg',
            'IMG_0543.jpg',
            'IMG_0544.jpg',
            'IMG_0549.jpg',
            'IMG_0551.jpg',
            'IMG_0554.jpg',
            'IMG_0555.jpg',
            'IMG_0559.jpg',
            'IMG_0562.jpg',
            'IMG_0569.jpg',
            'IMG_0574.jpg',
            'IMG_0575.jpg',
            'IMG_0581.jpg',
            'IMG_0585.jpg',
            'IMG_0586.jpg',
            'IMG_0588.jpg',
            'IMG_0598.jpg',
            'IMG_0603.jpg',
            'IMG_0610.jpg',
            'IMG_0613.jpg',
            'IMG_0616.jpg',
            'IMG_0617.jpg'
        ];
    
        return [
            'post_id' => 1,
            'order'  => rand(1, 100),
            'file_name'  => $images[array_rand($images)]
        ];
    }
}

namespace App\Image;

class Image
{
    public function getImageUrl($image) {
        if ($image != ""){
            $imageURL = "https://leger.market/pictures/product/middle/{$image}_middle.jpg";
            //$imageURL = "https://fakeimg.pl/300x300/7F7FFF/FFFFFF/?text={$image}&font=kelson";
        }
        else {
            $imageURL = "https://fakeimg.pl/300x300/EEEEEE/7F7F7F/?text=NO IMAGE&font=kelson";
        }
        return $imageURL;
    }
}
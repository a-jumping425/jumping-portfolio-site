<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SimpleImage;

class Media extends Model {
    /**
     * @var string
     */
    protected $table = 'media';

    public function uploadPortfolioFile(Request $request) {
        $file_data = [];

        $portfolio_id = $request->get('portfolio_id', 0);

        // Upload image
        if ($request->file('portfolio_file')) {
            $path = Storage::putFile('portfolios', $request->file('portfolio_file'));
            $url = Storage::url($path);

            // Save image info to database
            $mediaClass = new Media();
            $mediaClass->title = '';
            $mediaClass->path = $path;
            $mediaClass->url = $url;
            $mediaClass->file_name = $request->file('portfolio_file')->getClientOriginalName();
            $mediaClass->file_size = $request->file('portfolio_file')->getClientSize();
            $mediaClass->file_extension = $request->file('portfolio_file')->getClientOriginalExtension();
            $mediaClass->mimeType = $request->file('portfolio_file')->getClientMimeType();
            $mediaClass->temp = 1;
            $mediaClass->save();

            $file_data = [
                'id' => $mediaClass->id,
                'name' => $mediaClass->file_name,
                'size' => $mediaClass->file_size,
                'url' => $url,
                'path' => $path,
                'deleteType' => 'GET',
                'deleteUrl' => url('/admin_1lkh6x/portfolio/delete_file?mid='. $mediaClass->id .'&pid='. $portfolio_id)
            ];

            $image_extensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
            if (in_array(strtolower($mediaClass->file_extension), $image_extensions)) {
                $file_data['is_image'] = 1;
            }
        }

        return $file_data;
    }

    public function generatePortfolioThumbnail(Request $request) {
        $id = 0;

        // Upload image
        if ($request->file('thumbnail')) {
            $path = Storage::putFile('portfolio_featured_images', $request->file('thumbnail'));
            $url = Storage::url($path);

            // Save image info to database
            $mediaClass = new Media();
            $mediaClass->title = '';
            $mediaClass->path = $path;
            $mediaClass->url = $url;
            $mediaClass->file_name = $request->file('thumbnail')->getClientOriginalName();
            $mediaClass->file_size = $request->file('thumbnail')->getClientSize();
            $mediaClass->file_extension = $request->file('thumbnail')->getClientOriginalExtension();
            $mediaClass->mimeType = $request->file('thumbnail')->getClientMimeType();
            $mediaClass->temp = 1;
            $mediaClass->save();

            // Thumbnail
            $image = new SimpleImage();
            $thumbnail_filename = 'storage/portfolio_featured_images/'. pathinfo($mediaClass->path)['filename'] .'_400x300.'. $mediaClass->file_extension;
            $image->fromFile(public_path('storage/'.$path))->thumbnail(400, 300)->toFile(public_path($thumbnail_filename), $mediaClass->mimeType);

            $id = $mediaClass->id;
        }

        return $id;
    }}
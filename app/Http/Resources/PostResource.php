<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        //Untuk mengcustom API yang akan dipanggil. Baik untuk memfilter data yang akan ditampilkan dan
        // menambahkan data yang akan ditampilkan.
        return [
            'id' => $this->id,
            'title' => $this->title,
            'news_content' => $this->news_content,
            'created_at' => date_format($this->created_at, 'Y-m-d H:i:s'),
        ];
    }
}

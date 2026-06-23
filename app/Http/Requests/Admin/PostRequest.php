<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $postId = $this->route('post');

        return [
            'title'   => ['required', 'min:5', 'max:255', 'unique:posts,title,' . $postId],
            'content' => ['required', 'min:10'],
            'status'  => ['required', 'in:0,1'],
            'image'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'slug'    => ['nullable', 'string', 'min:5', 'max:255', 'unique:posts,slug,' . $postId, 'regex:/^[a-z0-9-]+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'Tiêu đề bài viết không được bỏ trống.',
            'title.min'        => 'Tiêu đề phải có ít nhất 5 ký tự.',
            'title.max'        => 'Tiêu đề không được vượt quá 255 ký tự.',
            'title.unique'     => 'Tiêu đề bài viết này đã tồn tại.',
            'content.required' => 'Nội dung bài viết không được bỏ trống.',
            'content.min'      => 'Nội dung phải có ít nhất 10 ký tự.',
            'status.required'  => 'Vui lòng chọn trạng thái.',
            'status.in'        => 'Trạng thái không hợp lệ.',
            'image.image'      => 'File tải lên phải là hình ảnh.',
            'image.mimes'      => 'Hình ảnh chỉ chấp nhận định dạng: jpeg, png, jpg, gif, webp.',
            'image.max'        => 'Hình ảnh không được vượt quá 2MB.',
            'slug.min'         => 'Đường dẫn (Slug) phải từ 5 ký tự trở lên.',
            'slug.max'         => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique'      => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
            'slug.regex'       => 'Slug chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'   => 'Tiêu đề',
            'content' => 'Nội dung',
            'status'  => 'Trạng thái',
            'image'   => 'Hình ảnh',
        ];
    }
}

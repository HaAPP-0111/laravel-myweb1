<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $brandid = $this->route('brand'); // lấy id từ route khi update

        return [
            'brandname' => ['required', 'min:2', 'max:150', 'unique:brands,brandname,' . $brandid . ',brandid'],
            'slug'      => ['required', 'string', 'min:5', 'max:150', 'unique:brands,slug,' . $brandid . ',brandid', 'regex:/^[a-z0-9-]+$/'],
            'status'    => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'brandname.required' => 'Tên thương hiệu không được bỏ trống.',
            'brandname.min'      => 'Tên thương hiệu phải có ít nhất 2 ký tự.',
            'brandname.max'      => 'Tên thương hiệu không được vượt quá 150 ký tự.',
            'brandname.unique'   => 'Tên thương hiệu này đã tồn tại trong hệ thống.',
            'slug.required'      => 'Slug không được bỏ trống.',
            'slug.min'           => 'Đường dẫn (Slug) phải từ 5 ký tự trở lên.',
            'slug.max'           => 'Slug không được vượt quá 150 ký tự.',
            'slug.unique'        => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
            'slug.regex'         => 'Slug chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.required'    => 'Vui lòng chọn trạng thái.',
            'status.in'          => 'Trạng thái không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'brandname' => 'Tên thương hiệu',
            'slug'      => 'Đường dẫn (Slug)',
            'status'    => 'Trạng thái',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product');

        return [
            'productname'   => ['required', 'min:3', 'max:200', 'unique:products,productname,' . $productId],
            'price'         => ['required', 'numeric', 'min:0', 'max:9999999'],
            'pricediscount' => ['required', 'numeric', 'min:0', 'lte:price'],
            'cateid'        => ['required', 'exists:categories,cateid'],
            'brandid'       => ['nullable', 'exists:brands,brandid'],
            'description'   => ['nullable', 'regex:/^[^@!$\^]*$/'],
            'status'        => ['required', 'in:0,1'],
            'img'           => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:200'],
            'imgs'          => ['nullable', 'array'],
            'imgs.*'        => ['image', 'mimes:jpg,jpeg,png,webp', 'max:200'],
            'slug'          => ['required', 'string', 'min:5', 'max:150', 'unique:products,slug,' . $productId, 'regex:/^[a-z0-9_-]+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'productname.required'   => 'Tên sản phẩm không được bỏ trống.',
            'productname.min'        => 'Tên sản phẩm phải có ít nhất 3 ký tự.',
            'productname.max'        => 'Tên sản phẩm không được vượt quá 200 ký tự.',
            'productname.unique'     => 'Tên sản phẩm này đã tồn tại trong hệ thống.',
            'price.required'         => 'Giá gốc không được bỏ trống.',
            'price.numeric'          => 'Giá gốc phải là số.',
            'price.min'              => 'Giá gốc không được nhỏ hơn 0.',
            'price.max'              => 'Giá gốc không được vượt quá 9.999.999 đ.',
            'pricediscount.required' => 'Giá khuyến mãi không được bỏ trống.',
            'pricediscount.numeric'  => 'Giá khuyến mãi phải là số.',
            'pricediscount.min'      => 'Giá khuyến mãi không được nhỏ hơn 0.',
            'pricediscount.lte'      => 'Giá khuyến mãi không được lớn hơn giá gốc.',
            'cateid.required'        => 'Vui lòng chọn danh mục.',
            'cateid.exists'          => 'Danh mục không hợp lệ.',
            'brandid.exists'         => 'Thương hiệu không hợp lệ.',
            'description.regex'      => 'Mô tả không được chứa các ký tự đặc biệt (@, !, $, ^).',
            'status.required'        => 'Vui lòng chọn trạng thái.',
            'status.in'              => 'Trạng thái không hợp lệ.',
            'img.required'           => 'Hình ảnh đại diện không được bỏ trống.',
            'img.image'              => 'Hình ảnh đại diện phải là hình ảnh.',
            'img.mimes'              => 'Hình ảnh đại diện chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
            'img.max'                => 'Hình ảnh đại diện không được vượt quá 200 KB.',
            'imgs.*.image'           => 'Hình ảnh phụ phải là hình ảnh.',
            'imgs.*.mimes'           => 'Hình ảnh phụ chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
            'imgs.*.max'             => 'Hình ảnh phụ không được vượt quá 200 KB.',
            'slug.required'          => 'Đường dẫn (Slug) không được bỏ trống.',
            'slug.min'               => 'Đường dẫn (Slug) phải từ 5 ký tự trở lên.',
            'slug.max'               => 'Slug không được vượt quá 150 ký tự.',
            'slug.unique'            => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
            'slug.regex'             => 'Slug chỉ được chứa chữ thường, số, dấu gạch dưới (_) và dấu gạch ngang (-).',
        ];
    }

    public function attributes(): array
    {
        return [
            'productname'   => 'Tên sản phẩm',
            'price'         => 'Giá gốc',
            'pricediscount' => 'Giá khuyến mãi',
            'cateid'        => 'Danh mục',
            'brandid'       => 'Thương hiệu',
            'description'   => 'Mô tả',
            'status'        => 'Trạng thái',
            'img'           => 'Hình ảnh đại diện',
            'imgs'          => 'Hình ảnh phụ',
        ];
    }
}

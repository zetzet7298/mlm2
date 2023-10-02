<!--begin::Action--->
<td class="text-end">
@if($model->content != 'Post Product' && $model->content != 'Update Product')
    <a href="{{ route('wallet.withdrawal.confirm', ['id' => $model->id]) }}" class="btn btn-sm btn-light btn-active-light-primary" onclick="return confirm('Are you sure ?')">
        Confirmed withdrawal
    </a>
    @endif
</td>
<!--end::Action--->

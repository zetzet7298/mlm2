<!--begin::Action--->
<td class="text-end">
    <a href="{{ route('wallet.withdrawal.confirm', ['id' => $model->id]) }}" class="btn btn-sm btn-light btn-active-light-primary" onclick="return confirm('Are you sure ?')">
        Confirmed withdrawal
    </a>
</td>
<!--end::Action--->

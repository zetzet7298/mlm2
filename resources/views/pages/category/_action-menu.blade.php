<!--begin::Action--->
<td class="text-end">
    <a href="{{ route('category.delete', ['id' => $model->id]) }}" class="btn btn-sm btn-danger btn-active-light-primary" onclick="return confirm('Are you sure ?')">
        Delete
    </a>
    <a href="{{ route('category.edit', ['id' => $model->id]) }}" class="me-2 btn btn-sm btn-success btn-active-light-primary">
        Edit
    </a>
</td>
<!--end::Action--->

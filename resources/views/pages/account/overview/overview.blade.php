<x-base-layout>

{{ theme()->getView('pages/account/_navbar', array('class' => 'mb-5 mb-xl-10')) }}

{{ theme()->getView('pages/account/overview/_details', array('class' => 'mb-5 mb-xl-10', 'info' => auth()->user()->info)) }}

@section('scripts')
<script>
function myclipboard(id){
        // Select elements
const target = document.getElementById(id);
const button = target.nextElementSibling;

// Init clipboard -- for more info, please read the offical documentation: https://clipboardjs.com/
clipboard = new ClipboardJS(button, {
    target: target,
    text: function () {
        return target.innerHTML;
    }
});

// Success action handler
clipboard.on('success', function (e) {
    var checkIcon = button.querySelector('.ki-check');
    var copyIcon = button.querySelector('.ki-copy');

    // Exit check icon when already showing
    if (checkIcon) {
        return;
    }

    // Create check icon
    checkIcon = document.createElement('i');
    checkIcon.classList.add('ki-duotone');
    checkIcon.classList.add('ki-check');
    checkIcon.classList.add('fs-2x');

    // Append check icon
    button.appendChild(checkIcon);

    // Highlight target
    const classes = ['text-success', 'fw-boldest'];
    target.classList.add(...classes);

    // Highlight button
    button.classList.add('btn-success');

    // Hide copy icon
    copyIcon.classList.add('d-none');

    // Revert button label after 3 seconds
    setTimeout(function () {
        // Remove check icon
        copyIcon.classList.remove('d-none');

        // Revert icon
        button.removeChild(checkIcon);

        // Remove target highlight
        target.classList.remove(...classes);

        // Remove button highlight
        button.classList.remove('btn-success');
    }, 3000)
});
}
myclipboard('kt_clipboard_4')
myclipboard('kt_clipboard_5')
</script>
@endsection
</x-base-layout>

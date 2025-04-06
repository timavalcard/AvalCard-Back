<div class="admin-delete-modal">
    <form action="" method="post">
        @csrf
        @method("delete")
        <p>شما می خواهید اینرا پاک کنید؟
            این کار غیر قابل برگشت است</p>
        <span class="admin-modal-close btn-blue">انصراف</span>
        <button class="btn btn-danger">حذف</button>
    </form>
</div>

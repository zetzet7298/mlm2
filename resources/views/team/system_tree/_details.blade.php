<div
  class="modal fade"
  id="modal_view_detail"
  tabindex="-1"
  aria-hidden="true"
>
  <!--begin::Modal dialog-->
  <div class="modal-dialog modal-dialog-centered mw-650px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header" id="kt_modal_add_customer_header">
        <!--begin::Modal title-->
        <h2 class="fw-bolder">Chi tiết user</h2>
        <!--end::Modal title-->
        <!--begin::Close-->
        <div
          id="kt_modal_add_customer_close"
          class="btn btn-icon btn-sm btn-active-icon-primary kt_modal_add_customer_cancel"
        >
          <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
          <span class="svg-icon svg-icon-1">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
            >
              <rect
                opacity="0.5"
                x="6"
                y="17.3137"
                width="16"
                height="2"
                rx="1"
                transform="rotate(-45 6 17.3137)"
                fill="black"
              ></rect>
              <rect
                x="7.41422"
                y="6"
                width="16"
                height="2"
                rx="1"
                transform="rotate(45 7.41422 6)"
                fill="black"
              ></rect>
            </svg>
          </span>
          <!--end::Svg Icon-->
        </div>
        <!--end::Close-->
      </div>
      <!--end::Modal header-->
      <!--begin::Modal body-->
      <div class="card-body p-9">
        <!--begin::Row-->
        <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Full name</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800 me-5" id="full_name"></span><span class="fs-6 badge badge-success" id="type"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Introductory Floor</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800" id="level"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
         <!--begin::Row-->
         <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Direct Referer</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800" id="direct_user"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Indirect Referer</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800" id="indirect_user"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Direct referral commissions</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800" id="direct_total"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Indirect referral commissions</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800" id="indirect_total"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <!--begin::Row-->
        <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Tiered referral commissions</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800" id="tiered_total"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Gold commissions</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800" id="gold_total"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-7">
          <!--begin::Label-->
          <label class="col-lg-5 fw-bold text-muted">Total commission received</label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-7">
            <span class="fw-bolder fs-6 text-gray-800" id="total"></span>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
      </div>
      <!--end::Modal body-->
      <!--begin::Modal footer-->
      <div class="modal-footer flex-center">
        <!--begin::Button-->
        <button
          type="reset"
          id="kt_modal_add_customer_cancel"
          class="kt_modal_add_customer_cancel btn btn-light me-3"
        >
          Đóng
        </button>
        <!--end::Button-->
        <!--begin::Button-->
        <!--end::Button-->
      </div>
      <!--end::Modal footer-->
      <div></div>
    </div>
  </div>
</div>

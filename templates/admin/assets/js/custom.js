function toSlug(title) {
    let slug = title.toLowerCase();    // chuyển thành chữ thường

    // xóa tất cả các ký tự đặc biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

    slug = slug.trim(); // xóa khoảng trắng 2 đầu
    // lọc dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'u');
    slug = slug.replace(/đ/gi, 'd');

    // chuyển dấu cách hay khoảng trắng thành gạch ngang
    slug = slug.replace(/ /gi, '-');

    return slug;
}
// lấy id từ url
let fullUrl = window.location.href
let seacrchParams = new URLSearchParams(fullUrl)
let id = seacrchParams.get('id')

let sourceTitle = document.querySelector('.slug');
let slugRender = document.querySelector('.render-slug');
let renderLink = document.querySelector('.render-link');
if (renderLink !== null) {
    // lấy slug tự động
    let slug = '';
    if (slugRender !== null) {
        slug = '/' + prefixUrl + '/' + slugRender.value.trim() + '-' + id + '.html';
    }

    if (id != null) {
        renderLink.querySelector('span').innerHTML = `<a href="${rootUrl + slug}" target="_blank">${rootUrl + slug}</a>`;
    }
    else  {
        renderLink.querySelector('span').innerHTML = 'Vui lòng cập nhật để hiển thị link';

    }
}



if (sourceTitle !== null && slugRender !== null) {
    sourceTitle.addEventListener('keyup', (e) => {
        if (!sessionStorage.getItem('save_slug')) {
            let title = e.target.value;
            //console.log(title);

            if (title !== null) {
                let slug = toSlug(title);
                slugRender.value = slug;
            }
        }

    });

    sourceTitle.addEventListener('change', () => {
        sessionStorage.setItem('save_slug', 1);

        if (id != null) {
            let currentLink = rootUrl + '/' + prefixUrl + '/' + slugRender.value.trim() + '-' + id + '.html';
            renderLink.querySelector('span a').innerHTML = currentLink;
            renderLink.querySelector('span a').href = currentLink;
        }

    })
    slugRender.addEventListener('change', (e) => {
        let slugValue = e.target.value;
        if (slugValue.trim() == '') {
            sessionStorage.removeItem('save_slug');
            let slug = toSlug(sourceTitle.value);
            e.target.value = slug;
        }

        if (id != null) {
            let currentLink = rootUrl + '/' + prefixUrl + '/' + slugRender.value.trim() + '-' + id + '.html';
            renderLink.querySelector('span a').innerHTML = currentLink;
            renderLink.querySelector('span a').href = currentLink;
        }

    })
    if (slugRender.value.trim() == '') {
        sessionStorage.removeItem('save_slug');
    }
}

// xử lý ckeditor với class
let classTextarea = document.querySelectorAll('.editor');
if (classTextarea !== null) {
    classTextarea.forEach((item, index) => {
        item.id = 'editor_' + (index + 1);
        CKEDITOR.replace(item.id);
    });
}

// xử lý mở popup ckfinder

function openCkfinder() {
    let chooseImage = document.querySelectorAll('.choose-image');
    if (chooseImage !== null) {
        chooseImage.forEach(function (item) {
            item.addEventListener('click', function () {
                let parentElementObject = this.parentElement;
                while (parentElementObject) {
                    parentElementObject = parentElementObject.parentElement;
                    if (parentElementObject.classList.contains('ckfinder-group')) {
                        break;
                    }
                }
                CKFinder.popup({
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function (finder) {
                        finder.on('files:choose', function (evt) {
                            let fileUrl = evt.data.files.first().getUrl(); //Xử lý chèn link ảnh vào input

                            parentElementObject.querySelector('.image-render').value = fileUrl;
                        });
                        finder.on('file:choose:resizedImage', function (evt) {
                            let fileUrl = evt.data.resizedUrl;
                            //Xử lý chèn link ảnh vào input
                            parentElementObject.querySelector('.image-render').value = fileUrl;
                        });
                    }
                });
            })
        })
    }
}
openCkfinder();

// Xử lí thêm dữ kiện dưới dạng Repeater
const galleryItemHtml = `<!-- Begin gallery item --> <div class="gallery-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row ckfinder-group">
                                        <div class="col-10">
                                            <input type="text" class="form-control image-render" name="gallery[]" placeholder="Đường dẫn ảnh..." value="">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="#" class="remove btn btn-danger btn-block">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- End gallery item -->`

const addGalleryObject = document.querySelector('.add-gallery');
const galleryImageObject = document.querySelector('.gallery-images');

if (addGalleryObject !== null && galleryImageObject !== null) {
    addGalleryObject.addEventListener('click', function (e) {
        e.preventDefault();     // ngăn tình trạng chạy mặc định của thẻ html (Thẻ a)
        let galleryItemHtmlNode = new DOMParser().parseFromString(galleryItemHtml, 'text/html').querySelector('.gallery-item');
        galleryImageObject.appendChild(galleryItemHtmlNode);
        openCkfinder();
    });
    // xóa
    galleryImageObject.addEventListener('click', function (e) {
        e.preventDefault();     // ngăn tình trạng chạy mặc định của thẻ html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                let galleryItem = e.target;
                while (galleryItem) {
                    galleryItem = galleryItem.parentElement;
                    if (galleryItem.classList.contains('gallery-item')) {
                        break;
                    }
                }
                if (galleryItem !== null) {
                    galleryItem.remove();
                }
            }
        }
    })
}

const slideItemHtml = `<div class="slide-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control" name="home_slide[slide_title][]" placeholder="Tiêu đề slide...">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Nút xem thêm</label>
                    <input type="text" class="form-control" name="home_slide[slide_button_text][]" placeholder="Chữ của nút...">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link xem thêm</label>
                    <input type="text" class="form-control" name="home_slide[slide_button_link][]" placeholder="Link của nút...">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link Youtube</label>
                    <input type="text" class="form-control" name="home_slide[slide_video][]" placeholder="Link video youtube...">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-11">
                            <label for="">Ảnh 1</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" class="form-control image-render" name="home_slide[slide_image_1][]" placeholder="Đường dẫn ảnh..." value="">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-11">
                            <label for="">Ảnh 2</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" class="form-control image-render" name="home_slide[slide_image_2][]" placeholder="Đường dẫn ảnh..." value="">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="home_slide[slide_desc][]" class="form-control" placeholder="Mô tả sldie..."></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-11">
                            <label for="">Ảnh nền</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" class="form-control image-render" name="home_slide[slide_bg][]" placeholder="Đường dẫn ảnh..." value="">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Vị trí</label>
                    <select name="home_slide[slide_position][]" class="form-control">
                        <option value="left">Trái</option>
                        <option value="center">Giữa</option>
                        <option value="right">Phải</option>
                    </select>
                </div>
            </div>
        </div>


    </div>
    <div class="col-1">
        <a href="#" class="btn btn-danger btn-block remove">&times;</a>
    </div>
</div>
</div>`

const addSlideObject = document.querySelector('.add-slide')
const slideWrapperObject = document.querySelector('.slide-wrapper')
if (addSlideObject !== null && slideWrapperObject !== null) {
    addSlideObject.addEventListener('click', function () {

        let slideItemHtmlNode = new DOMParser().parseFromString(slideItemHtml, 'text/html').querySelector('.slide-item');
        slideWrapperObject.appendChild(slideItemHtmlNode);
        openCkfinder();
    })
    // xóa
    slideWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();     // ngăn tình trạng chạy mặc định của thẻ html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                let slideItem = e.target;
                while (slideItem) {
                    slideItem = slideItem.parentElement;
                    if (slideItem.classList.contains('slide-item')) {
                        break;
                    }
                }
                if (slideItem !== null) {
                    slideItem.remove();
                }
            }
        }
    })
}

const skillItemHtml = `<div class="skill-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Tên năng lực</label>
                                                <input type="text" class="form-control" name="home_about[skill][name][]" placeholder="Tên năng lực...">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Giá trị</label>
                                                <input type="text" class="ranger form-group" name="home_about[skill][value][]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="" class="btn btn-danger btn-sm btn-block remove">x</a>
                                </div>
                            </div>
                        </div>`

const addSkillObject = document.querySelector('.add-skill')
const skillWrapperObject = document.querySelector('.skill-wrapper')

if (addSkillObject !== null && skillWrapperObject !== null) {
    addSkillObject.addEventListener('click', function () {

        let skillItemHtmlNode = new DOMParser().parseFromString(skillItemHtml, 'text/html').querySelector('.skill-item');
        skillWrapperObject.appendChild(skillItemHtmlNode);
        openCkfinder();
        $('.ranger').ionRangeSlider({
            min: 0,
            max: 100,
            type: 'single',
            step: 1,
            postfix: ' %',
            prettify: false,
            hasGrid: true
        });
    })

    // xóa
    skillWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();     // ngăn tình trạng chạy mặc định của thẻ html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                let skillItem = e.target;
                while (skillItem) {
                    skillItem = skillItem.parentElement;
                    if (skillItem.classList.contains('skill-item')) {
                        break;
                    }
                }
                if (skillItem !== null) {
                    skillItem.remove();
                }
            }
        }
    })
    $('.ranger').ionRangeSlider({
        min: 0,
        max: 100,
        type: 'single',
        step: 1,
        postfix: ' %',
        prettify: false,
        hasGrid: true
    });
}

/* Partner */
const partnerItemHtml = `<div class="partner-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <label for="">Logo</label>
                                                        <div class="row ckfinder-group">
                                                            <div class="col-10">
                                                                <input type="text" class="form-control image-render" name="home_partner_content[logo][]" placeholder="Đường dẫn ảnh..." value="">
                                                            </div>
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Link</label>
                                                <input type="text" class="form-control" placeholder="Link..." name="home_partner_content[link][]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="" class="btn btn-danger btn-sm btn-block remove">x</a>
                                </div>
                            </div>
                        </div>`

const addPartnerObject = document.querySelector('.add-partner')
const partnerWrapperObject = document.querySelector('.partner-wrapper')

if (addPartnerObject !== null && partnerWrapperObject !== null) {
    addPartnerObject.addEventListener('click', function () {

        let partnerItemHtmlNode = new DOMParser().parseFromString(partnerItemHtml, 'text/html').querySelector('.partner-item');
        partnerWrapperObject.appendChild(partnerItemHtmlNode);
        openCkfinder();
    }
    )

    // xóa
    partnerWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();     // ngăn tình trạng chạy mặc định của thẻ html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                let partnerItem = e.target;
                while (partnerItem) {
                    partnerItem = partnerItem.parentElement;
                    if (partnerItem.classList.contains('partner-item')) {
                        break;
                    }
                }
                if (partnerItem !== null) {
                    partnerItem.remove();
                }
            }
        }
    })
}

//
/* Partner */
const teamItemHtml = `<div class="team-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Tên</label>
                                                <input type="text" class="form-control" placeholder="Tên..." name="team-content[name][]" value="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Chức vụ</label>
                                                <input type="text" class="form-control" placeholder="Chức vụ..." name="team-content[position][]" value="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <label for="">Ảnh</label>
                                                        <div class="row ckfinder-group">
                                                            <div class="col-10">
                                                                <input type="text" class="form-control image-render" name="team-content[image][]" placeholder="Đường dẫn ảnh..." value="">
                                                            </div>
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Facebook</label>
                                                <input type="text" class="form-control" placeholder="Facebook..." name="team-content[facebook][]" value="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Twitter</label>
                                                <input type="text" class="form-control" placeholder="Twitter..." name="team-content[twitter][]" value="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">linkedIn</label>
                                                <input type="text" class="form-control" placeholder="linkedIn..." name="team-content[linkedin][]" value="">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Behance</label>
                                                <input type="text" class="form-control" placeholder="Behance..." name="team-content[behance][]" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="" class="btn btn-danger btn-sm btn-block remove">x</a>
                                </div>
                            </div>
                        </div>`

const addTeamObject = document.querySelector('.add-team')
const teamWrapperObject = document.querySelector('.team-wrapper')

if (addTeamObject !== null && teamWrapperObject !== null) {
    addTeamObject.addEventListener('click', function () {

        let teamItemHtmlNode = new DOMParser().parseFromString(teamItemHtml, 'text/html').querySelector('.team-item');
        teamWrapperObject.appendChild(teamItemHtmlNode);
        openCkfinder();
    }
    )

    // xóa
    teamWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();     // ngăn tình trạng chạy mặc định của thẻ html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xóa?')) {
                let teamItem = e.target;
                while (teamItem) {
                    teamItem = teamItem.parentElement;
                    if (teamItem.classList.contains('team-item')) {
                        break;
                    }
                }
                if (teamItem !== null) {
                    teamItem.remove();
                }
            }
        }
    })
}
// menu editor custom

// sortable list options
var sortableListOptions = {
    placeholderCss: { 'background-color': "#cccccc" }
};
var editor = new MenuEditor('myEditor',
    {
        listOptions: sortableListOptions,
        maxLevel: 2 // (Optional) Default is -1 (no level limit)
        // Valid levels are from [0, 1, 2, 3,...N]
    });
editor.setForm($('#frmEdit'));
editor.setUpdateButton($('#btnUpdate'));
//Calling the update method
$("#btnUpdate").click(function () {
    editor.update();
});
// Calling the add method
$('#btnAdd').click(function () {
    editor.add();
});
if (typeof arrayJson !== 'undefined') {
    editor.setData(arrayJson);
}

if ($('.save-menu').length > 0) {
    $('.save-menu').on('click', function (e) {
        e.preventDefault()  // vô hiệu hóa submit form
        var str = editor.getString();
        $('#menu-content').val(str)
        $('#frmEdit').submit()
    })
}

// xử lý check phân quyền
let permissionObj = document.querySelector('.permission-lists');

if (permissionObj != null) {
    const  allowRoles = [
        'add',
        'edit',
        'delete',
        'duplicate'
    ]
    let rowPermissionObj = permissionObj.querySelectorAll('tr');

    if (rowPermissionObj != null) {
        rowPermissionObj.forEach(function (item){
            let checkBoxObj = item.querySelectorAll('input[type="checkbox"]')

            if (checkBoxObj != null) {
                checkBoxObj.forEach(function (checkbox) {
                    checkbox.addEventListener('click', function () {
                        let checkBoxValue = this.value;

                        if (checkBoxValue.trim() !== '' && allowRoles.includes(checkBoxValue)) {
                            let viewRole = item.querySelectorAll('input[value="lists"]')

                            if (viewRole !== null) {
                                viewRole[0].checked = true
                            }
                        }
                    })
                })
            }
        })
    }
}
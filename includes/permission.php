<?php
// lấy bảng permission tương ứng với module, action
function checkPermission($permissionData, $module, $role = 'lists')
{
    if (!empty($permissionData[$module])) {
        $roleArr = $permissionData[$module];
        if (!empty($roleArr) && in_array($role, $roleArr)) {
            return true;
        }
    }
    return false;
}
// lấy group_id hiện tại của id dăng nhập
function getGroupId()
{
    $userId = islogin()['user_id'];

    $groupRow = firstRaw("SELECT group_id FROM users WHERE id = $userId");

    if (!empty($groupRow)) {
        $groupId = $groupRow['group_id'];
        return $groupId;
    }
    return false;
}
// lấy mảng permission trong bảng group
function getPermissionData($groupId)
{
    $groupRow = firstRaw("SELECT permission FROM groups WHERE id=$groupId");

    if (!empty($groupRow)) {
        $permissionData = json_decode($groupRow['permission'], true);
        return $permissionData;
    }
    return false;
}
function checkCurrentPermission($role = '', $module = '')
{
    $groupId = getGroupId();
    $permissionData = getPermissionData($groupId);
    $body = getBody('get');

    $currentModule = null;

    // lấy module
    if (!empty($module)) {
        $currentModule = $module;
    } else if (!empty($body['module'])) {
        $currentModule = $body['module'];
    }

    // lấy action
    if (!empty($role)) {
        $action = $role;
    } else {
        $action = !empty($body['action']) ? $body['action'] : 'lists';
    }



    if (!empty($action)) {
        $checkPermission = checkPermission($permissionData, $currentModule, $action);
        return $checkPermission;
    }
}
return false;

function redirectPermission($path = 'admin')
{
    setFlashData('msg', 'Bạn không có quyền truy cập');
    setFlashData('msg_type', 'danger');
    redirect($path);
}

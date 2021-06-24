<main class="flex-column d-flex mb-5">
    <div class="mb-3">
        <?php
        if(!empty($_SESSION["user"]["data"]["user_location"]) && json_decode($_SESSION["user"]["data"]["user_location"])){
            $json = json_decode($_SESSION["user"]["data"]["user_location"]);
            $location = true;
        ?>
        <div id="alert" class="pt-3">
            <div class="alert alert-warning">
                <span>你已填写过地址 <span class="font-weight-bold">(可以更改)</span></span>
            </div>
        </div>
        <?php
        }else{
            $location = false;
        }
        ?>
        <form id="formLocation" class="mb-3" method="POST">
            <div class="my-4 bg-white p-4 box-shadow-round small-round">
                <div class="form-group form-row">
                    <div class="col-6">
                        <label for="name" class="font-weight-bold">名字 (英文)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo ($location)?$json->name:""?>" required>
                    </div>
                    <div class="col-6">
                        <label for="surname" class="font-weight-bold">姓名 (英文)</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="<?php echo ($location)?$json->surname:""?>" required>
                    </div>
                </div>
            </div>
            <div class="my-4 bg-white p-4 box-shadow-round small-round">
                <div class="form-group">
                    <label for="contact-mobile" class="font-weight-bold">手机号码</label>
                    <input type="text" class="form-control" id="contact-mobile" name="mobile" placeholder="12345678" value="<?php echo ($location)?$json->mobile:""?>" required>
                </div>
                <div class="form-group">
                    <label for="contact-phone" class="font-weight-bold">电话号码</label>
                    <input type="text" class="form-control" id="contact-phone" name="phone" placeholder="12345678" value="<?php echo ($location)?$json->phone:""?>" required>
                </div>
            </div>
            <div class="my-4 bg-white p-4 box-shadow-round small-round">
                <div class="form-group form-row">
                    <div class="col-6">
                        <label for="country" class="font-weight-bold">国家 (英文)</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo ($location)?$json->country:""?>" required>
                    </div>
                    <div class="col-6">
                        <label for="postal" class="font-weight-bold">邮编</label>
                        <input type="text" class="form-control" id="postal" name="postal" placeholder="1234" value="<?php echo ($location)?$json->postal:""?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="province" class="font-weight-bold">省/州/区</label>
                    <input type="text" class="form-control" id="province" name="province" placeholder="Province" value="<?php echo ($location)?$json->province:""?>" required>
                </div>
                <div class="form-group">
                    <label for="city" class="font-weight-bold">城市</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo ($location)?$json->city:""?>" required>
                </div>
                <div class="form-group">
                    <label for="address" class="font-weight-bold">详细地址</label>
                    <textarea id="" cols="30" rows="3" class="form-control" id="address" name="address" placeholder="Address" required><?php echo ($location)?$json->address:""?></textarea>
                </div>
            </div>
            <div class="text-center my-2 adv">
                <small>地址填写错了, 自己承担错误</small>
            </div>
            <button type="submit" class="btn btn-danger btn-block py-3 my-5" id="check_location"><?php echo ($location)?"更改":"提交"?></button>
        </form> 
    </div>
</main>
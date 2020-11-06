<?php
error_reporting(0);
// шаблон для формы
include rootPath() . '/templates/header.php';

session_start();
unset($_GET['route']);
//var_dump($_POST);
//var_dump($_COOKIE);
$cookies = unserialize(stripslashes($_COOKIE['forma']));
//var_dump($cookies);
$_SESSION = $_GET;
//var_dump($_SESSION);
//var_dump($error);
if (empty($_SESSION) AND !empty($cookies)){
    include_once rootPath() . '/templates/users/uploadForm.php';
}

if (!empty($_SESSION)):
        ($_SESSION['Save']=='Not Ok')? $_GET['error'] = null: $_GET['error'];
        if (!empty($_GET['error'])): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $_GET['error'] ?></div>
        <?php endif; ?>

<form method="POST" enctype='multipart/form-data' action="/users/register">
    <fieldset>
        <div class="c1">
            <p><h1>Student Registration Form</h1>Fill out the form carefully for registration</p>
        </div>

        <div class="c1">
            <h4>Student Name</h4>
            <div class="flex">
                <div class="input">
                    <input type="text" name="full_name[first_n]" value="<?= (($_SESSION['Save']=='Not Ok'))?'':$cookies['full_name']['first_n']?>">
                    <p>First Name</p>
                </div>
                <div class="input">
                    <input type="text"  name="full_name[middle_n]" value="<?= ($_SESSION['Save']=='Not Ok')?'':$cookies['full_name']['middle_n'] ?>">
                    <p>Middle Name</p>
                </div>
                <div class="input">
                    <input type="text"  name="full_name[last_n]"value="<?= ($_SESSION['Save']=='Not Ok')?'':$cookies['full_name']['last_n'] ?>">
                    <p>Last Name</p>
                </div>
            </div>
        </div>
        <div class="clear"></div>

        <div class="c1">
            <h4>Nickname</h4>
            <div class="input">
                <input type="text" name="nickname[nickname]" value="<?= (($_SESSION['Save']=='Not Ok'))?'':$cookies['nickname']['nickname']?>">
                <p>Nickname</p>

            </div>
        </div>

        <div class="c1">
            <h4>Password</h4>
            <div class="input">
                <input type="text" name="password[password]" value="<?= (($_SESSION['Save']=='Not Ok'))?'':$cookies['password']['password']?>">
                <p>Password</p>

            </div>
        </div>

        <div class="c1">
            <h4>Email</h4>
            <div class="input">
                <input type="text"  name="email[email]" value="<?= ($_SESSION['Save']=='Not Ok')?'':$cookies['email']['email'] ?>">
                <p>Email</p>

            </div>
        </div>
        </div>
        <div class="clear"></div>

        <div class="c1">
            <p> <h4>Birth day</h4></p>
            <div class="flex">
                <div class="input">
                    <select name="birth_data[day]">
                        <option hidden="true"> </option>
                        <option> 5</option>
                        <option> 6</option>
                        <option> 7</option>
                    </select>
                    <p>Day</p>
                </div>
                <div class="input">
                    <select name="birth_data[month]">
                        <option hidden="true"> </option>
                        <option> May</option>
                        <option> June</option>
                        <option> July</option>
                    </select>
                    <p>Month</p>
                </div>
                <div class="input">
                    <select name="birth_data[year]">
                        <option hidden="true"> </option>
                        <option> 1999</option>
                        <option> 2000</option>
                        <option> 2001</option>
                    </select>
                    <p>Year</p>
                </div>
            </div>


            <div>
            </div>
            <p> <h4>Gender</h4></p>
            <input type="radio" name="gender[gender]" value="Male" checked> Male
            <input type="radio" name="gender[gender]" value="Female"> Female
        </div>
        <div class="clear"></div>


        <div>
            <h4>Adress</h4>
            <div class="colum">
                <div class="flex">
                    <div class="input">
                        <input type="text" name="full_address[city]" value="<?= ($_SESSION['Save']=='Not Ok')?'':$cookies['full_address']['city']?>">
                        <p>City</p>
                    </div>
                    <div class="input">
                        <input size="22%" type="text" name="full_address[street_address]" value="<?= ($_SESSION['Save']=='Not Ok')?'':$cookies['full_address']['street_address']?>">
                        <p>Street Address</p>
                    </div>
                </div>
            </div>

            <div class="colum">
                <div class="flex">
                    <div class="input">
                        <input type="text" name="full_address[zip_code]" value="<?= ($_SESSION['Save']=='Not Ok')?'':$cookies['full_address']['zip_code']?>">
                        <p>Postal/Zip Code</p>
                    </div>
                    <div class="input">
                        <select name="full_address[country]">
                            <option hidden="true" value=""> Please Select</option>
                            <option> Ukraine</option>
                            <option> USA</option>
                            <option> Japan</option>
                            <option> England</option>
                        </select>
                        <p>Country</p>
                    </div>
                </div>
            </div>
        </div>


        <div>
            <h4>Courses</h4>
            <select name="course[]" multiple>
                <option hidden="truie"></option>>
                <option value="Windows 10">Windows 10</option>
                <option value="Windows 8">Windows 8</option>
                <option value="Windows 7">Windows 7</option>
                <option value="Windows Xp">Windows Xp</option>
            </select>
        </div>

        <div>
            <h4>Send files</h4>
            <?php for ($i=0;$i<3;$i++): ?>
                <input type="file" accept="image/bmp,image/jpeg,image/png" name="image[]">
            <?php endfor; ?>
        </div>
        </div>


        <div>
            <h4>Additional Comments</h4>
            <textarea cols="100" rows="10" name="textarea[textarea]"></textarea>
        </div>


        <input class="button1" type="submit" value="Submit Application">
        <input class="button2" type="reset"  value="Clear Fields">
        <input type="hidden" name="button" value="true">
    </fieldset>
</form>

<?php
    endif;
session_unset();
session_destroy();
    include rootPath() . '/templates/footer.php'; ?>
<?php

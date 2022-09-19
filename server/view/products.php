<?php
class products
{
    public static function list($search_id = 0)
    {
        $pageData = DEFAULT_PAGE_DATA;

        $DB = new db_pdo();
        $DB->connect();
        // var_dump($search_id === 0);
        // die();
        if ($search_id === 0) {
            $products = $DB->querySelect("SELECT id, name, category, vendor, quantityInStock, cost,retailPrice FROM products");
        } else {
            $products = $DB->querySelectParams("SELECT  id, name, category, vendor, quantityInStock, cost,retailPrice FROM products WHERE id=?", [$search_id]);
        }
        $number = count($products);
        $tbHtml = tableToHtml($products, 100);

        $pageData['content'] = "";


        $pageData['content'] .= <<<HTML
        <h2  class="error"> Product list   <a   href="index.php?op=140" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i></a ></h2>
        <h3>Number of products : $number </h3>
            <form  class="table" action="index.php"  >
            <input type="hidden" name="op" value="100"/>
            <p> Search for id :<input  class="form-control" name="search_id" /> <button class="btn btn-primary">Go</button> <a href='index.php?op=100'>Show all</a></p>
           </form>

                {$tbHtml}

        HTML;
        webpage::render($pageData);
        return;
    }

    /**
     * print new product creation form
     */

    public static function new($msg = "", $previousData = [])
    {
        if ($previousData === []) {
            $previousData = [
                'email' => '',
                'pwd' => ''
            ];
        }
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-New product";
        $pageData['content'] = <<<HTML
            <h2  class="error"> {$msg} </h2>

        <form class="needs-validation"action="index.php" method="POST"  novalidate>
            <div class="alert alert-danger d-none">Please review the problems below:</div>

            <div class="row mb-3">
                <label for="exampleInputName" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="exampleInputName" placeholder="Your name" required>
                <div class="invalid-feedback">Name can't be blank</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Text input example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="exampleInputEmail" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                <input type="email" class="form-control" id="exampleInputEmail" placeholder="Enter email" autocomplete="email" required>
                <div class="invalid-feedback">Email can't be blank</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="exampleInputPassword" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" autocomplete="current-password" required>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Password input example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="exampleCustomFile" class="col-sm-3 col-form-label">Avatar</label>
                <div class="col-sm-9">
                <input type="file" class="form-control" id="exampleCustomFile" required>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">File input example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="exampleTextareaBio" class="col-sm-3 col-form-label">Bio</label>
                <div class="col-sm-9">
                <textarea class="form-control" id="exampleTextareaBio" rows="2" placeholder="Tell us your story" required></textarea>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Textarea input example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Birthday</label>
                <div class="col-sm-9">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <select id="exampleInputDateYear" class="form-select me-1" required>
                    <option></option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    </select>

                    <select id="exampleInputDateMonth" class="form-select mx-1" required>
                    <option></option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    </select>

                    <select id="exampleInputDateDay" class="form-select ms-1" required>
                    <option></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    </select>
                </div>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Date multi select example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label pt-0">Color</label>
                <div class="col-sm-9">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleInlineRadioColor" id="exampleInlineRadio1" value="option1" required>
                    <label class="form-check-label" for="exampleInlineRadio1">Red</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleInlineRadioColor" id="exampleInlineRadio2" value="option2" required>
                    <label class="form-check-label" for="exampleInlineRadio2">Pink</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleInlineRadioColor" id="exampleInlineRadio3" value="option3" required>
                    <label class="form-check-label" for="exampleInlineRadio3">Violet</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleInlineRadioColor" id="exampleInlineRadio4" value="option4" required>
                    <label class="form-check-label" for="exampleInlineRadio4">Indigo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleInlineRadioColor" id="exampleInlineRadio5" value="option5" required>
                    <label class="form-check-label" for="exampleInlineRadio5">Blue</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleInlineRadioColor" id="exampleInlineRadio6" value="option6" required>
                    <label class="form-check-label" for="exampleInlineRadio6">Teal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleInlineRadioColor" id="exampleInlineRadio7" value="option7" required>
                    <label class="form-check-label" for="exampleInlineRadio7">Green</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleInlineRadioColor" id="exampleInlineRadio8" value="option8" required>
                    <label class="form-check-label" for="exampleInlineRadio8">Yellow</label>
                </div>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Collection as inline radio buttons example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label pt-0">Fruit</label>
                <div class="col-sm-9">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox1" value="option1" required>
                    <label class="form-check-label" for="exampleInlineCheckbox1">Apple</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox2" value="option2" required>
                    <label class="form-check-label" for="exampleInlineCheckbox2">Banana</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox3" value="option3" required>
                    <label class="form-check-label" for="exampleInlineCheckbox3">Cherry</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox4" value="option4" required>
                    <label class="form-check-label" for="exampleInlineCheckbox4">Coconut</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox5" value="option5" required>
                    <label class="form-check-label" for="exampleInlineCheckbox5">Grape</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox6" value="option6" required>
                    <label class="form-check-label" for="exampleInlineCheckbox6">Lime</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox7" value="option7" required>
                    <label class="form-check-label" for="exampleInlineCheckbox7">Mango</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox8" value="option8" required>
                    <label class="form-check-label" for="exampleInlineCheckbox8">Orange</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox9" value="option9" required>
                    <label class="form-check-label" for="exampleInlineCheckbox9">Pear</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="exampleInlineCheckbox10" value="option10" required>
                    <label class="form-check-label" for="exampleInlineCheckbox10">Pineapple</label>
                </div>
                <div class="form-text">Collection as inline check boxes example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="exampleSelectMusic" class="col-sm-3 col-form-label">Music</label>
                <div class="col-sm-9">
                <select multiple="" class="form-select" id="exampleSelectMusic" required>
                    <option value="rock">Rock</option>
                    <option value="pop">Pop</option>
                    <option value="jazz">Jazz</option>
                    <option value="heavy_metal">Heavy Metal</option>
                    <option value="hip_hop">Hip Hop</option>
                    <option value="house">House</option>
                    <option value="electronic_dance">EDM</option>
                    <option value="dance">Dance</option>
                    <option value="techno">Techno</option>
                </select>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Collection multiple select example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="exampleSelectLanguage" class="col-sm-3 col-form-label">Language</label>
                <div class="col-sm-9">
                <select class="form-select" id="exampleSelectLanguage" required>
                    <option value="">Select your Language</option>
                    <option value="en">English</option>
                    <option value="de">German</option>
                    <option value="es">Spanish</option>
                    <option value="ru">Russian</option>
                </select>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Collection select example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label pt-0">Pill</label>
                <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadiosPill" id="exampleRadiosPillRed" value="red" required>
                    <label class="form-check-label" for="exampleRadiosPillRed">
                    Red pill
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadiosPill" id="exampleRadiosPillBlue" value="blue" required>
                    <label class="form-check-label" for="exampleRadiosPillBlue">
                    Blue pill
                    </label>
                </div>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Collection as radio buttons example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label pt-0">Choises</label>
                <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="exampleCheckbox1" value="option1" required>
                    <label class="form-check-label" for="exampleCheckbox1">Learn the Ruby programming language</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="exampleCheckbox2" value="option1" required>
                    <label class="form-check-label" for="exampleCheckbox2">Create a Ruby on Rails application</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="exampleCheckbox3" value="option1" required>
                    <label class="form-check-label" for="exampleCheckbox3">Practice Ruby, Rails, Tests and Simple Form</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="exampleCheckbox4" value="option1" required>
                    <label class="form-check-label" for="exampleCheckbox4">Deploy your application in the cloud</label>
                </div>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Collection as check boxes example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="exampleInputFriends" class="col-sm-3 col-form-label">Friends</label>
                <div class="col-sm-9">
                <input type="number" class="form-control" id="exampleInputFriends" placeholder="Number of Friends" required>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Integer input example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="exampleRangeMood" class="col-sm-3 col-form-label pt-0">Mood</label>
                <div class="col-sm-9">
                <input type="range" class="form-range" id="exampleRangeMood" required>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Integer range example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Awake</label>
                <div class="col-sm-9">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <select id="exampleInputTimeHour" class="form-select me-1" required>
                    <option></option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    </select>
                    :
                    <select id="exampleInputTimeMinute" class="form-select ms-1" required>
                    <option></option>
                    <option value="00">00</option>
                    <option value="30">30</option>
                    </select>
                </div>
                <div class="invalid-feedback">Please provide a valid value.</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Time multi select example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First kiss</label>
                <div class="col-sm-9">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <select id="exampleInputDatetimeYear" class="form-select me-1" required>
                    <option></option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    </select>

                    <select id="exampleInputDatetimeMonth" class="form-select mx-1" required>
                    <option></option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    </select>

                    <select id="exampleInputDatetimeDay" class="form-select mx-1" required>
                    <option></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    </select>
                    —
                    <select id="exampleInputDatetimeHour" class="form-select mx-1" required>
                    <option></option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    </select>
                    :
                    <select id="exampleInputDatetimeMinute" class="form-select ms-1" required>
                    <option></option>
                    <option value="00">00</option>
                    <option value="30">30</option>
                    </select>
                </div>
                <div class="form-text">Datetime multi select example</div>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label pt-0">Active</label>
                <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleBooleanRadio" id="exampleBooleanRadioYes" value="red" required>
                    <label class="form-check-label" for="exampleBooleanRadioYes">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleBooleanRadio" id="exampleBooleanRadioNo" value="red" required>
                    <label class="form-check-label" for="exampleBooleanRadioNo">No</label>
                </div>
                <div class="invalid-feedback">Terms must be accepted</div>
                <div class="valid-feedback">Looks good!</div>
                <div class="form-text">Boolean as radio button example</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-9 offset-sm-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="exampleCheckTerms" required>
                    <label class="form-check-label" for="exampleCheckTerms">Terms</label>
                    <div class="invalid-feedback">Terms must be accepted</div>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="form-text">Boolean as check box example</div>
                </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary">Create User!</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </div>
        </form>
        HTML;
        webpage::render($pageData);
    }

    /**
     * print new product creation form
     */

    public static function show($id)
    {

        $DB = new db_pdo();
        $DB->connect();
        $product = $DB->querySelect("Select * from products where id='$id'  ;", PDO::FETCH_OBJ);

        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . "-Show product";
        $pageData['content'] = <<<HTML

            <h2  class="error"> {$product[0]->name} </h2>
            <div class="card" style="text-align:center">
                <img src="images/product.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">{$product[0]->description}</p>
                    <div>
                    <a   href="index.php?op=100" class="btn btn-primary"><i class="fa fa-list" aria-hidden="true"></i></i></a >

                    <a   href='index.php?op=130&id={ $product[0]->id }' class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a >
                            <a    href="index.php?op=190" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a >
                    </div>
                </div>
            </div>
     HTML;
        webpage::render($pageData);
    }
}

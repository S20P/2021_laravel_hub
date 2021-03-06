<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Client Side Validation</title>
        <style>
            body{ padding-top: 50px; padding-left: 100px; }
            .error { color: red; }
        </style>
    </head>
    <body>
        <form id="demo-form">
            <div>
                <label for="fullname">Full Name *</label> <br>
                <input type="text" class="form-control" name="fullname" required>
            </div>
            <br>            
            <div>
                <label for="email">Email *</label> <br>
                <input type="email" class="form-control" name="email" required>
            </div>
            <br>
            <div>
                <label for="contactMethod">Preferred Contact Method *</label> <br>
                <p>
                    Email: <input type="radio" name="contactMethod" id="contactMethodEmail" value="Email" required="">
                    Phone: <input type="radio" name="contactMethod" id="contactMethodPhone" value="Phone">
                </p>
            </div>
            <br>
            <div>
                <label for="hobbies">Hobbies (Optional, but 2 minimum):</label> <br>
                <p>
                    Skiing <input type="checkbox" name="hobbies[]" id="hobby1" value="ski"><br>
                    Running <input type="checkbox" name="hobbies[]" id="hobby2" value="run"><br>
                    Eating <input type="checkbox" name="hobbies[]" id="hobby3" value="eat"><br>
                    Sleeping <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep"><br>
                    Reading <input type="checkbox" name="hobbies[]" id="hobby5" value="read"><br>
                    Coding <input type="checkbox" name="hobbies[]" id="hobby6" value="code"><br>
                </p>
            </div>
            <br>            
            <div>
                <p>
                <label for="heard">Heard about us via *</label> <br>
                <select id="heard" required="">
                    <option value="">Choose..</option>
                    <option value="press">Press</option>
                    <option value="net">Internet</option>
                    <option value="mouth">Word of mouth</option>
                    <option value="other">Other..</option>
                </select>
                </p>
            </div>
            <br>
            <div>
                <p>
                <label for="message">Message (20 chars min, 100 max) :</label> <br>
                <textarea id="message" class="form-control" name="message"></textarea>
                </p>
            </div>
            <br>
            <div>
                <input type="submit" class="btn btn-default" value="validate">
            </div>
        </form>

<!-- jQuery Library -->
<script src="{{asset('js/jquery.js')}}"></script>

<!-- jQuery Validation Library -->
<script src="{{asset('js/jquery-validator.js')}}"></script>

<!-- Basic jQuery Validation -->
<script type="text/javascript">
    /** We are using basic id selector which is assigned to form 
    * validate() will validate your form
    */
    $('#demo-form').validate({
        /** Rules for your form fields */
        rules : {
            /** Field name is the name of your input, select, textarea */
            /** rule_name -> required, value -> true */
            fullname : {
                required : true,
                minlength: 3
            },
            email : {
                required: true,
                email: true
            },
            contactMethod : {
                required: true
            },
            "hobbies[]" : {
                required: true,
                minlength: 2
            }
        },
        /** Adding custom messages to your validation rules */
        messages : {
            /** Field name that you have added in the rules */
            /** rule_name and its respective message when it gets triggered */
            email : {
                required : "Email field required"
            },
            "hobbies[]" : {
                required : "Please select atleast 2 hobbies",
                minlength: "Please select {0} hobbies"
            }
        }
    });
</script>


    </body>
</html>
<?php
session_start();
require_once 'classes/class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
  $reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
  $uname = trim($_POST['txtuname']);
  $email = trim($_POST['txtemail']);
  $upass = trim($_POST['txtpass']);
  $code = md5(uniqid(rand()));
  $name_f=trim($_POST['fname']);
  $name_l=trim($_POST['lname']);
  $name=$name_f." ".$name_l;
  
  $stmt = $reg_user->runQuery("SELECT * FROM users WHERE email=:email_id");
  $stmt->execute(array(":email_id"=>$email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount() > 0)
  {
    $msg = ' <div class="col-md-offset-3 col-md-6"><div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Sorry!</h4>
                    email allready exists , Please Try another one
                  </div></div>';
    // $msg = "
    //       <div class='alert alert-error'>
    //     <button class='close' data-dismiss='alert'>&times;</button>
    //       <strong>Sorry !</strong>  email allready exists , Please Try another one
    //     </div>
    //     ";
  }
  else
  {
    if($reg_user->register($uname,$email,$upass,$code,$name))
    {     
      $id = $reg_user->lasdID();    
      $key = base64_encode($id);
      $id = $key;
      
      $message = "          
            Hello $uname,
            <br /><br />
            Welcome to THALAPALAKANADA TEA factory!<br/>
            To complete your registration  please , just click following link.<br/>you can login to the system after admin approved you.<br/>
            <br /><br />
            <a href='http://localhost/tsms/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
            <br /><br />
            Thanks,";
            
      $subject = "Confirm Registration";
            
      $reg_user->send_mail($email,$message,$subject);
      $msg ='<div class="col-md-offset-3 col-md-6"><div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                    We have sent an email to '.$email.' Please click on the confirmation link in the email to create your account.
                  </div></div>'; 
      // $msg = "
      //     <div class='alert alert-success'>
      //       <button class='close' data-dismiss='alert'>&times;</button>
      //       <strong>Success!</strong>  We've sent an email to $email.
      //               Please click on the confirmation link in the email to create your account. 
      //       </div>
      //     ";
    }
    else
    {
      echo "sorry , Query could no execute...";
    }   
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tsms | Registation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/TsmsUI.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/green.css">
  </head>
  <body class="hold-transition login-page">
      <br>
    <div class="row">
      <div class="col-xs-10">
        <h4 class="pull-right"><a href="thalapalakanada.lk"><b>Vist Us</b></a></h4>
      </div>
    </div>
    <?php if(isset($msg)) echo $msg;  ?>  
    <div class="row">
      <div class="col-md-5">
        <div class="login-box">
          <div class="login-logo">
            <br>
            <a href="login.html"><img src="dist/Llogo.png"></a>
          </div><!-- /.login-logo -->
          <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <form class="form-signin" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="First Name" name="fname" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Last Name" name="lname" />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="txtuname" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email address" name="txtemail" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="txtpass" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input required type="checkbox"> I agree to the <a href="#myModal" role="button" data-toggle="modal">Terms and Conditions</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn bg-olive btn-flat" name="btn-signup">Register</button>
            </div><!-- /.col -->
          </div>
        </form>

        <!-- terms model -->
        <div id="myModal" class="login-dialog modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Terms and Conditions for System users</h4>
                    </div>
                    <div class="modal-body">
                        <p>This acceptable use policy (or AUP) details the sorts of <br>content that a user may - and may not - submit to a website, forum or blog for publication.

The template comes in three different flavours. <br>The contents of each are identical: only the terminology varies.

The publication of user-generated <br>content (UGC) by a website operator may create liabilities for the operator, even where the website operator does not exercise any editorial function and does not moderate the UGC.

The policy may be used to prohibit <br>both unlawful content and offensive content. Unlawful content includes content that is defamatory, obscene, in breach of privacy laws or infringing intellectual property rights. Offensive content may include content that is pornographic, graphically violent, or perhaps just uncivil or unsuitable for your the relevant website, forum or blog.

As well as rules about what UGC can <br><br>and cannot be submitted to the website, this policy includes an express grant from the website user to the website owner of a right to use the UGC. Whilst the provision of content by a user would typically result in the grant of an implied licence to the website operator, it is much better for the website operator to know exactly what can and cannot be done with the content, and that request an express written licence,

This acceptable usage policy is an extended version of the policies on usage contained in our blog terms and conditions template, our social networking terms and conditions and our other website terms of use templates designed to cover user-generated content.

Acceptable use policies in detail<br><br>

Acceptable use policies set out the <br>kinds of website use that are acceptable and the kinds of website use that are unacceptable.

One big area of worry for web publishers<br> whose sites publish user content is the possibility of getting sued because that content is defamatory, infringes someone's copyright, breaches a court order or is otherwise unlawful. Even though a web publisher might not review user content before publication, and might not even be aware that it has been published, the publisher can still be held to be liable in respect of that content.

The harshness of this principle is mitigated<br> in the UK by special rules under the Electronic Commerce (EC Directive) Regulations 2002, the Defamation Act 1996 and the Defamation Act 2013. However, Regulations 17 to 19 of the former include special defences in relation to hosting, caching and acting as a "mere conduit" of unlawful content. The use of a properly drafted acceptable use policy, together with appropriate business policies and mechanisms, could make the difference between the success or failure of a defence under the 2002 Regulations or the 1996 and 2013 Acts.

Each of our acceptable use policies should be <br>used in conjunction with a website terms of use document (or website disclaimer document), which will cover the other legal issues affecting websites, such as limitations of liability and statutory disclosures.
Most websites that allow the publication of user generated content require registration, and registration almost always involves the collection of personal information. If you collect personal information through a website, you may also need a website privacy policy to aid compliance with the Data Protection Act 1998.

Contents of this AUP <br><br>

The key provision in each policy include the following.<br>

General restrictions: The general restrictions <br>section focuses upon the use of the website generally, rather than the specific nature of the user content. Unlawful, illegal, fraudulent and harmful usage may be prohibited using this section. You may also specify here that user content must be suitable for users of the appropriate age group. This is a subjective criterion but, insofar as children are concerned, there will be clear cases of suitability and unsuitability.

Licence: Some acceptable use policies purport to<br> transfer the copyright in user postings to the web publisher. However, users do not normally expect this to be the effect of posting material to a website, and anyway such a transfer may be ineffective under English law, which requires transfers of copyright to be in writing and signed by the transferor.

Instead, the template policies include a<br> broad licence to use the user content. The licence as drafted is irrevocable and non-exclusive, and covers the use, reproduction, publishing, adaptation, translation and distribution of the user content. It also includes a right to sub-license and a right to bring proceedings for infringement (for instance, against scraper sites). In many context users will find such a licence to be over-broad, and you should therefore consider the ways in which you can limit the licence without unnecessarily inhibiting the usefulness of the user content to your business,

Unlawful and illegal material: A general <br>prohibition on unlawful and illegal content is supplemented here by specific prohibitions covering libel, malicious falsehood, obscenity, indecency, IP infringement, breach of confidence, data protection breaches, negligent misstatement, incitement, contempt, etc.

Marketing and spam: The use of the website <br>for marketing purposes, at least without express permission, is prohibited by this section.

Breaches of this Policy: The acceptable use policy templates<br>provide that a user who breaches the policy terms may suffer any or all of the following consequences: the deletion or editing of the user's content; the issue of formal warnings; the suspension or prohibition of access to the site or service; the blockage of access via IP address; requests to the user's ISP that the user be blocked from accessing the site or service; and/or the issue of court proceedings.</p>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-navy btn-flat">Accept</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- terms end -->
        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>
 -->
        <a href="index.php" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
        </div><!-- /.login-box -->
      </div>
      <div class="row">
        <div class="">
          <div class="col-md-6">
                <br>
                <div class="box-body">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="dist/img/image1.png" alt="First slide">
                        <div class="carousel-caption">
                          Thalapalakanada
                        </div>
                      </div>
                      <div class="item">
                        <img src="dist/img/image2.png" alt="Second slide">
                        <div class="carousel-caption">
                          Tea
                        </div>
                      </div>
                      <div class="item">
                        <img src="dist/img/image3.png" alt="Third slide">
                        <div class="carousel-caption">
                          Factory
                        </div>
                      </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          <div class="col-md-6 textcenter">
            <h1><span class="thalapalakanada"><b>THALAPALAKANADA</b></span></h1>
            <h3>Tea Factory</h3>
            <h5>This is Thalapalakanada tea factory official web site if you have no account Please <a class="link" href="register.html">Register!</a> in here</h5>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

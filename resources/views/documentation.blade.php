{{-- 

	^ update welcome.blade.php

	^ edit RedirectIfAuthenticated, if (Auth::guard($guard)->check()) {
            return redirect('/check');
        }

    # In ResetPasswordController.php, redirect to login after resetting password
				protected $redirectTo = '/login';

		# In ResetsPasswords.php, remove the following in resetPassword function inorder to prevent users from logging in directly after a password reset
				//$this->guard()->login($user);		
--}}
<?php

namespace App\Http\Controllers\User;

    use App\Http\Controllers\BaseController;
    use App\Http\Requests\RegisterAuthRequest;
    use App\Infrastructure\Model\User;
    use Illuminate\Http\Request;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends BaseController
{
    public $loginAfterSignUp = true;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
        return $this->successJson();
    }

    public function login(Request $request)
    {
        $input = $request->only('mobile', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return $this->errorJson('Invalid Mobile or Password',401);
        }

        return $this->successJson([
            'token' => 'Bearer '.$jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return $this->successJson([], 'User logged out successfully');
        } catch (JWTException $exception) {
            return $this->errorJson('Sorry, the user cannot be logged out', 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
//            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        if(!$user){
            return $this->errorJson('登陆信息不正确');
        }

        return $this->successJson(['user' => $user]);
    }
}

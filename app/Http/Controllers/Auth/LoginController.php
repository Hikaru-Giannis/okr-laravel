<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;

final class LoginController extends Controller
{
    /**
     * @param AuthManager $auth
     */
    public function __construct(
        private AuthManager $auth,
    ) {
    }

    /**
     * ログイン処理
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     *
     * @OA\POST(
     *   path="/login",
     *   summary="ログイン処理",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="status",
     *         type="int",
     *         description="レスポンスステータス",
     *         example=200
     *       ),
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         description="レスポンスメッセージ",
     *         example="Authenticated."
     *       )
     *     )
     *   )
     * )
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if ($this->auth->guard()->attempt($credentials)) {
            $request->session()->regenerate();

            return new JsonResponse([
                'status' => 200,
                'message' => 'Authenticated.'
            ]);
        }

        throw new AuthenticationException();
    }
}

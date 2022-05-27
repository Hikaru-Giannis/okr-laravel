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
     *   @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        type="object",
     *        required={"email", "password"},
     *        @OA\Property(
     *            property="email",
     *            type="string",
     *            example="test@example.com",
     *            description="メールアドレス"
     *        ),
     *        @OA\Property(
     *            property="password",
     *            type="string",
     *            example="password",
     *            description="パスワード"
     *        )
     *      )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success Login.",
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
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Failure Login.",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         description="レスポンスメッセージ",
     *         example="Unauthenticated."
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

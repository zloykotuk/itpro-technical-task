export interface SignUpRequest {
    first_name: string | null,
    last_name: string | null,
    password: string | null,
    password_confirmation: string | null,
    email: string | null,
    integrator_id: string | null,
}

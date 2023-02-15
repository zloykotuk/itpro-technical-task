export interface ModelType {
    firstName: string | null,
    lastName: string | null,
    email: string | null,
    password: string | null,
    reenteredPassword: string | null,
    integrator: string | null,
}

export interface ModelRequest {
    first_name: string | null,
    last_name: string | null,
    password: string | null,
    password_confirmation: string | null,
    email: string | null,
    integrator_id: string | null,
}

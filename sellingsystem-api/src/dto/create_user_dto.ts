export interface CreateUserDTO {
  username: string;
  password: string;
  cpf?: string | undefined;
  role: string;
}
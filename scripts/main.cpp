#include <iostream>
#include <math.h>
#include <sstream>
#include <iomanip>

#define ITER_COUNT 12 

float fun_for_calc(float x)
{
    return cos(x);
    //return pow(x, 5) + 4 * pow(x, 3) + x;
}

int fact(int k)
{
    int f = 1;
    for (int i = 1; i <= k; i++)
    {
        f *= i;
    }
    return f;
}

// Calculation of cos(x) by Taylor series expansion. x0 = pi / 4
// The first ITER_COUNT+1 terms of the series are calculated.
// float cos_x_taylor(float x)
// {
//     float num = 0, den = 0, f = 0, f_prev = 0, eps = 0;
//     int n1 = 0, n2 = 0, sign = 0;
//     for (int k = 0; k < ITER_COUNT; k++)
//     {
//         num = x - M_PI / 4;
//         num = pow(num, k);
//         den = fact(k);
//         int mod = k % 4;
//         if (mod == 0 || mod == 3)
//         {
//             sign = 1;
//         } 
//         else
//         {
//             sign = -1; 
//         }

//         f_prev  = f;
//         f      += sign * num / den;
//         eps     = fabs(f - f_prev);

//         // std::cout << "k = " << std::setw(2) << k 
//         //           << "; sign = " << std::setw(2) << sign 
//         //           << "; num = " << std::fixed << std::setprecision(6) << std::setw(9) << num 
//         //           << "; den = " << std::fixed << std::setprecision(0) << std::setw(9) << den 
//         //           << "; f = " << std::fixed << std::setprecision(6) << f 
//         //           << "; eps = " << std::fixed << std::setprecision(6) << eps << "\n";
//     }
//     return f * sqrt(2.0) / 2;
// }

float cos_x_taylor_eps(float x, float e)
{
    float num = 0, den = 0, f = 0, f_prev = 0, eps = 0;
    int n1 = 0, n2 = 0, sign = 0, k = 0;
    do
    {
        num = x - M_PI / 4;
        num = pow(num, k);
        den = fact(k);
        int mod = k % 4;
        if (mod == 0 || mod == 3)
        {
            sign = 1;
        } 
        else
        {
            sign = -1; 
        }

        f_prev  = f;
        f      += sign * num / den;
        eps     = fabs(f - f_prev);
        k++;
    }
    while (eps >= e);
    return f * sqrt(2.0) / 2;
}

int main(int argc, char* argv[])
{
    float f, eps; //f = 0;
    if (argc < 2) {
        // std::cerr << "Please provide x as command line argument\n";
        std::cerr << "Please provide two arguments: x and ε\n";
        return 1;
    }
    float x = std::stof(argv[1]);
    float e = std::stof(argv[2]);
    float result = cos_x_taylor_eps(x, e);
    // std::cin >> x >> e;
    // float x = 0.365, f = 0;
    // f = cos_x_taylor(x);
    std::cout << result;
}
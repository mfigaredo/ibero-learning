<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\Course;
use App\Helpers\Currency;
use Illuminate\Support\Collection;

/**
 * Class Cart
 * @package App\Classes
 */
class Cart
{
    /**
     * @var Collection
     */
    // protected Collection $cart;
    protected $cart;

    /**
     * Cart constructor.
     */
    public function __construct() {
        if(session()->has('cart')) {
            $this->cart = session('cart');
        } else {
            $this->cart = new Collection;
        }
    }

    /**
     * Get cart contents
     */
    public function getContent(): Collection {
        return $this->cart;
    }

    /**
     * Save the cart on session
     */
    protected function save(): void {
        session()->put('cart', $this->cart);
        session()->save();
    }

    /**
     * Add course on cart
     * @param Course $course
     */
    public function addCourse(Course $course): void {
        if(!$this->cart->contains($course)) {
            $this->cart->push($course);
            $this->save();
        }
    }

    /**
     * Remove course from cart
     * @param int $id
     */
    public function removeCourse(int $id): void {
        $this->cart = $this->cart->reject(function (Course $course) use ($id) {
            return $course->id === $id;
        });
        $this->save();
    }

    /**
     * Calculates the total cost in the cart
     * @param bool $formatted
     * @return mixed
     */
    public function totalAmount($formatted = true) {
        $amount = $this->cart->sum(function (Course $course) {
            return $course->price;
        });
        if($formatted) {
            return Currency::formatCurrency($amount);
        }
        return $amount;
    }

    /**
     *
     * all taxes for cart
     *
     * @param bool $formatted
     * @return float|int|string
     */
    public function taxes($formatted = true) {
        $total = $this->totalAmount(false);
        if ($total) {
            $total = ($total * env('TAXES')) / 100;
            if ($formatted) {
                return Currency::formatCurrency($total);
            }
            return $total;
        }
        return 0;
    }

    /**
     *
     * Total products in cart
     *
     * @return int
     */
    public function hasProducts(): int {
        return $this->cart->count();
    }

    /*
     * Clear cart
     */
    public function clear(): void {
        $this->cart = new Collection;
        $this->save();
    }

    /**
     *
     * calculates the total cost in the cart with coupon
     *
     * @param bool $formatted
     * @return string
     */
    public function totalAmountWithDiscount($formatted = true) {
        $amount = $this->totalAmount(false);
        $withDiscount = $amount;
        if (session()->has("coupon")) {
            $coupon = Coupon::available(session("coupon"))->first();
            if (!$coupon) {
                return $amount;
            }

            $coursesInCart = $this->getContent()->pluck("id");
            if ($coursesInCart) {
                // courses attached to coupon in database
                $coursesForApply = $coupon->courses()->whereIn("id", $coursesInCart);

                // id courses attached on database for apply coupon
                $idCourses = $coursesForApply->pluck("id")->toArray();

                if (!count($idCourses)) {
                    $this->removeCoupon();
                    session()->flash("message", ["danger", __("El cupón no se puede aplicar")]);
                    return $amount;
                }

                // total price courses without discount applied
                $priceCourses = $coursesForApply->sum("price");

                // check discount type and apply
                if ($coupon->discount_type === Coupon::PERCENT) {
                    $discount = round($priceCourses - ($priceCourses * ((100 - $coupon->discount) / 100)), 2);
                    $withDiscount = max( 0, $amount - $discount );
                }
                if ($coupon->discount_type === Coupon::PRICE) {
                    $withDiscount = max( 0, $amount - $coupon->discount );
                    // $withDiscount = $withDiscount > 0 ? $withDiscount : 0;
                }
            } else {
                $this->removeCoupon();
                return $amount;
            }
        }
        // if ($formatted) {
        //     return Currency::formatCurrency($withDiscount);
        // }
        // return $withDiscount;
        return $formatted ? Currency::formatCurrency($withDiscount) : $withDiscount;
    }

    protected function removeCoupon():void {
        session()->remove("coupon");
        session()->save();
    }

    public function courseInCart(Course $course) {
        // dd($this->cart->pluck('id'));
        return $this->cart->pluck('id')->contains($course->id);
    }
}